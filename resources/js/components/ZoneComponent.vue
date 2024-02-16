<template>
  <form @submit.prevent="submitForm">
  <div class="row">
    <div class="col-md-6">
      <label class="form-label">Region*</label>
      <select data-placeholder="Select Region" class="form-select" name="" id="" v-model="selectedRegion" ref="selectDropdown">
        <option v-for="row in regions" :value="row.id">{{row.name}}</option>
      </select>
    </div>

    <div class="col-md-6">
      <label class="form-label">City*</label>
      <select data-placeholder="Select City" class="form-select" name="" id="" v-model="selectedCity" ref="citySelectDropdown">
        <option v-for="row in selectedCities" :value="row.id">{{row.name}}</option>
      </select>
    </div>
  </div>

  <div class="card mt-3" v-for="(zones, city_id_item) in selectedZones" :key="city_id_item" >
    <div class="card-header">
      <div  v-for="row in selectedCities" >
        <div v-if="city_id_item == row.id">
          <li>{{ row.name }}</li>
        </div>
      </div>
    </div>

    <div class="card-body">
      <div class="col-md-6">
        <label class="form-label">Zone*</label>
        <select data-placeholder="Select Zone" class="form-select" v-model="selectedZone"  ref="zoneSelectDropdown" :data-cityId="city_id_item">
          <option v-for="(zone_name, zone_id) in zones" :value="zone_id">{{zone_name}}</option>
        </select>

      </div>

      <div class="row" v-for="(areas, zone_id) in zoneData[city_id_item]">
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <div class="column">
                <h2>Unselected Record</h2>
                <select class="multi-select" v-model="unselectArea" multiple>
                  <option v-for="(area_name, area_id) in unselectArray[zone_id]" :key="area_id" :value="area_id" @click="moveToSecondArray(city_id_item,zone_id,area_id,area_name)">
                    {{ area_name }}{{area_id}}
                  </option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="column">
                <h2>Selected Record</h2>
                <select class="multi-select" v-model="selectArea" multiple>
                  <option v-for="(area, area_index) in areas" :key="area.id" :value="area.id" @click="moveToFirstArray(city_id_item,zone_id,area.id,area.name,area_index)" :selected="selectArea.includes(area.id)">
                   {{ area_index}} {{ area.name}}
                  </option>
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</template>
<script>
import { defineComponent } from 'vue'
import { VueDraggableNext } from 'vue-draggable-next'
import Select2 from 'vue3-select2-component';
import axios from "axios";

export default {
  components: {
    draggable: VueDraggableNext,
    Select2
  },
  name: 'ZoneComponent',
  props: ['regions'],
  data() {
    return {
      unselectArea:[],
      selectArea:[],
      city_id: '',
      selectedCities: [],
      selectedZones: {},
      selectedRegion: '',
      unSelectedRegions: [],
      selectedCity: '',
      selectedZone:'',
      totalArea:[],
      subTotalArea:[ ],
      selectedArea: [ ],
      unSelectedArea: [ ],
      zoneData:{},
      zone_id_test:'',
      unselectArray:[],
      areas_value: {},
      ZoneValue:[]
    };
  },

  methods: {
    submitForm(){
      const selectedValues = this.selectArea.map((item) => item.value);
      console.log('Selected Region:', this.selectedRegion);
      console.log('Selected City:', this.city_id);
      console.log('Selected Zone:',this.ZoneValue);
      console.log('Selected  select:',this.zoneData);


    },
    regionDropdown() {
      // Initialize the first Select2 dropdown
      $(this.$refs.selectDropdown).select2({
        multiple: true,
      }).on('change', (event) => {
        const selectedCityIds = $(event.target).val();
        this.selectedRegion = $(event.target).val();
        axios.get('/users/getRegionCity?region_id=' + selectedCityIds)
            .then((response) => {
              this.selectedCities = response.data;
            });
      });
    },

    cityDropdown() {
      // Initialize the second Select2 dropdown
      let ths1 = this;
      let i = 0;
      $(this.$refs.citySelectDropdown).select2({
        multiple: true
      }).on('change', (event) =>{
        this.city_id = $(event.target).val();
        this.selectedCity = $(event.target).val();
        //empty selected zones
        this.selectedZones = {};
            if(this.selectedZones != ''){
                this.unselectArray = []
                this.zoneData =[]
              }
        axios.get('/users/getZone?city_id=' + this.city_id)
            .then(response => {
              this.selectedZones = {};
              Object.entries(response.data).forEach(([city_id_item, item]) => {
                this.selectedZones[city_id_item] = {}
                item.forEach((item2, index) => {
                  this.selectedZones[city_id_item][item2.id] = item2.zoneName;
                });
              });

              //  Use this.$nextTick to initialize the zoneSelectDropdown after Vue updates the DOM
              this.$nextTick(() => {
                $('body').find(ths1.$refs.zoneSelectDropdown).select2({
                  multiple: true
                }).on('change', (event) =>{
                  const Zone_ids = $(event.target).val();
                  this.ZoneValue += Zone_ids+',';
                  var zoneArray = this.ZoneValue.split(',');
                  var uniqueZoneSet = new Set(zoneArray);
                 console.log(uniqueZoneSet);
                 // this.selectedZone = $(event.target).val();
                  const city_id_item = $(event.target).attr('data-cityId');
                  this.zoneData[city_id_item] = {};
                  this.unselectArray = [];
                  if(Zone_ids !== ''){
                    axios.get('/users/getArea?zone_id=' + Zone_ids )
                        .then(response =>{
                            this.zoneData[city_id_item]= response.data;
                        });
                  }
                });

              });
            })
      });
    },
    moveToSecondArray(city_id,zone_id,area_id,area_name) {
      delete this.unselectArray[zone_id][area_id];
      const obj = {id:area_id,name:area_name};
      this.zoneData[city_id][zone_id].push(obj);
    },

    moveToFirstArray(city_id,zone_id,area_id,area_name,area_index) {
      if(typeof this.unselectArray[zone_id] == 'undefined'){
        this.unselectArray[zone_id] = {};
      }
      this.unselectArray[zone_id][area_id] = area_name;
      this.zoneData[city_id][zone_id].splice(area_index, 1)[0];
      console.log('zone value',this.unselectArray)
      console.log(this.unselectArray[zone_id][area_id])
    },

  },

  // watch: {
  //   selectedCity(newCityId) {
  //     axios.get('/users/getZone?city_id=' + newCityId)
  //         .then(response => {
  //           //this.selectedZones = response.data ;
  //           // this.selectedZones[newCityId] = [];
  //           this.selectedZones[newCityId] = response.data;
  //         });
  //   },
  // },

  mounted() {
    this.regionDropdown();
    this.cityDropdown();
    // this.zoneDropdown();
  }
};
</script>

<style>
.two-columns {
  display: flex;
}
select.multi-select {
  display: block;
  min-width: 200px;
  min-height: 200px;
}
.column {
  flex: 1;
  border: 1px solid #ccc;
  padding: 10px;
  margin: 10px;
}

.column-list {
  min-height: 50px;
  border: 2px dashed #ddd;
}

.drag-item {
  background-color: #e0e0e0;
  padding: 10px;
  margin: 5px;
  cursor: grab;
  user-select: none;
}
</style>
<!--// Object.entries(response.data).forEach(([city_id_item, item]) => {-->
<!--//-->
<!--//-->
<!--//   item.forEach((item2, index) => {-->
<!--//     console.log("zone 2",  this.zoneData[city_id_item]);-->
<!--//     // console.log("zone city",  this.zoneData[city_id_item]);-->
<!--//      // this.zoneData[city_id_item][item2.id] = item2.name;-->
<!--//     // console.log("zone value2",this.zoneData[city_id_item]);-->
<!--//-->
<!--//   });-->
<!--//-->
<!--// });-->