<template>
  <div style="margin: 0 auto;width: 800px">
    <div class="row mt-3">
      <div class="col-md-12">
        <label class="form-label">Region <span class="red-asterisk">*</span></label>

        <multiselect class="mb-2"
                     ref="regionRef"
                     v-model="regionId" :options="regions"
                     @select="getCitiesByRegion($event)"
                     @remove="removeCitiesByRegion($event)"
                     :searchable="false"
                     limit="3"
                     :multiple="true"
                     :close-on-select="false" :clear-on-select="true"
                     :preserve-search="true" placeholder="Seach in Region" label="name"
                     track-by="name" :preselect-first="false"
        >
          <template v-slot:tag="{ option, remove }">
              <span :class="(option['$isDisabled']?'multiselect__tag disabled':'multiselect__tag')">
                <span>{{ option.name }}</span>

                <i v-if="option['$isDisabled']" @click="removeItemDisabled(option)" tabindex="1"
                   class="multiselect__tag-icon"></i>
                <i v-else @click="remove(option)" tabindex="1" class="multiselect__tag-icon"></i>
              </span>
          </template>
        </multiselect>
      </div>
      <div class="col-md-12 mt-2">
        <label class="form-label">City <span class="red-asterisk">*</span></label>
        <multiselect class="mb-2"
                     ref="citiesRef"
                     @select="populateCitiesChange($event)"
                     @remove="removeCityFromCities($event)"
                     v-model="cityId" :options="cities"
                     :searchable="false"
                     :multiple="true"
                     :close-on-select="false"
                     :clear-on-select="true"
                     :preserve-search="true"
                     :custom-label="cityLabel"
                     placeholder="Seach in Cities" label="cityName" track-by="cityName" :preselect-first="false">
          <template v-slot:tag="{ option, remove }">
              <span :class="(option['$isDisabled']?'multiselect__tag disabled':'multiselect__tag')">
                <span>{{ option.cityName }} - {{ option.regionName }}</span>
                <i v-if="option['$isDisabled']" @click="removeItemDisabled(option)" tabindex="1"
                   class="multiselect__tag-icon"></i>
                <i v-else @click="remove(option)" tabindex="1" class="multiselect__tag-icon"></i>
              </span>
          </template>
        </multiselect>
        <!--        <select multiple class="form-select" v-model="cityId" @change="populateCitiesChange($event)" ref="cityRef">
                  <option @click="selectedCitiesHandle($event,row)" v-for="row in cities" :value="row.cityId"
                          :selected="(row.selected)">{{ row.cityName }} - {{ row.regionName }}
                  </option>
                </select>-->
      </div>

      <div class="col-md-12 mt-2">
        <label class="form-label">Zone </label>

        <multiselect class="mb-2"
                     ref="zoneRef"
                     @select="zoneChangeHandle($event)"
                     @remove="zoneRemoveHandle($event)"
                     v-model="zoneId" :options="zones"
                     :multiple="true"
                     :close-on-select="false"
                     :clear-on-select="true"
                     :preserve-search="true"
                     :custom-label="zoneLabel"
                     placeholder="Seach in Zones"
                     label="zoneName"
                     track-by="zoneName"
                     :preselect-first="false"
        >
          <template v-slot:tag="{ option, remove }">
              <span :class="(option['$isDisabled']?'multiselect__tag disabled':'multiselect__tag')">
                <span>{{ option.zoneName }} - {{ option.cityName }}</span>
                <i v-if="option['$isDisabled']" @click="removeItemDisabled(option)" tabindex="1"
                   class="multiselect__tag-icon"></i>
                <i v-else @click="remove(option)" tabindex="1" class="multiselect__tag-icon"></i>
              </span>
          </template>
        </multiselect>

        <!--        <select multiple class="form-select" v-model="zoneId">
                  <option @click="zoneChangeHandle($event,row)" v-for="row in zones" :value="row.zoneId"
                          :selected="(row.selected)">{{ row.zoneName }} - {{ row.cityName }}
                  </option>
                </select>-->
      </div>
      <div class="col-md-12 mt-2">
        <label class="form-label">Area </label>

        <multiselect class="mb-2"
                     ref="areaRef"
                     @select="inputAreaHandle($event)"
                     @remove="inputRemoveAreaHandle($event)"
                     v-model="areaId" :options="areas"
                     :multiple="true" :close-on-select="true"
                     :clear-on-select="true"
                     :preserve-search="true"
                     :custom-label="areaLabel"
                     placeholder="Seach in Area"
                     label="areaName"
                     track-by="areaName"
                     :preselect-first="false"
        >
          <template v-slot:tag="{ option, remove }">
              <span :class="(option['$isDisabled']?'multiselect__tag disabled':'multiselect__tag')">
                <span>{{ option.areaName }} - {{ option.zoneName }} - {{ option.cityName }}</span>
                <i v-if="option['$isDisabled']" @click="removeItemDisabled(option)" tabindex="1"
                   class="multiselect__tag-icon"></i>
                <i v-else @click="remove(option)" tabindex="1" class="multiselect__tag-icon"></i>
              </span>
          </template>
        </multiselect>
        <!--        <select multiple class="form-select" v-model="areaId">

                  <option v-for="row in areas" :value="row.areaId"
                          :selected="(row.selected)">{{ row.areaName }} - {{ row.cityName }}
                  </option>
                </select>-->
      </div>
      <div class="col-md-12 mt-2 mb-4">
        <button :disabled="loader" @click="submitForm" type="button" class="btn btn-primary">
          {{ selectedareas.length > 0 ? 'Update' : 'Update' }}
        </button>
        <button @click="cancelForm" type="button" class="ml-1 btn btn-primary">
          Cancel
        </button>
      </div>
    </div>
  </div>
</template>


<script>
import {ref} from "vue";
import axios from "axios";


export default {
  components: {},
  name: 'ZoneNewComponent',
  setup() {
    const cityRef = ref(null);
    return {
      cityRef
    }
  },
  props: [
    'regions',
    'userid',
    'selectedcities',
    'selectedzones',
    'selectedareas',
    'selectedregions',
    'selectedzones_collect'
  ],

  created() {
    this.selectedregions.length > 0 && this.selectedregions.map((region) => {
      this.getCitiesByRegion(region);
    });

    this.selectedcities.length > 0 && this.selectedcities.map((city) => {
      this.populateCitiesChange(city);
    });
    this.selectedzones.length>0 && this.selectedzones.map((zone)=>{
      axios.get(`/users/getArea?zone_id=${zone.zoneId}`)
          .then(response => {
            response.data.map((area) => {
              let regionCityZoneAreaIndex = this.searchItem(this.areas, 'areaId', area.id);
              if (regionCityZoneAreaIndex === -1) {
                const area1 = {
                  areaId: area.id,
                  areaName: area.name,
                  zoneId: zone.zoneId,
                  cityId: area.cityId,
                  regionId: zone.regionId,
                  cityName: zone.cityName,
                  zoneName: zone.zoneName,
                  selected: true
                };
                this.areas.push(area1);
              }
            });
            this.$forceUpdate();
            window.hideLoader()
          });
    })
  },
  data() {
    return {
      loader: false,
      regionId: this.selectedregions,
      cityId: this.selectedcities,/* selected cities*/
      zoneId: this.selectedzones,/* selected zones*/
      areaId: this.selectedareas,/* selected areas*/
      cities: this.selectedcities,/* all cities aganist selected regions*/
      zones: this.selectedzones, /* all zones against selected cities*/
      areas: []
    }
  },
  methods: {
    removeItemDisabled(option) {
      window.sweetAlertCrm(
          'Sorry!',
          'It cannot unassigned already used',
          'Ok',
      );
    },
    cancelForm() {
      window.location.href = '/users'
    },

    submitForm() {
      const userId = this.userid;
      this.loader = true
      window.showLoader()
      const area = this.areaId;
      if (area.length > -1) {
        axios.post(`/users/assign-zone/${userId}/store`, {
          areas: area
        }).then((result) => {
          const {success, message} = result.data
          console.log(result.data, 'result.data')
          if (success) {
            window.toastr.success(message)
            setTimeout(() => {
              window.location.href = '/users'
            }, 1000)
          } else {
            window.toastr.error('Error')
          }
          console.log(result, result.data, 'result')
          window.hideLoader()
          this.loader = false
        }).catch((error) => {
          console.log(error, 'error')
          window.toastr.error('Error')
        })
      }
      console.log(this.areas, 'areas')
    },
    areaLabel(area) {
      return `${area.areaName} - ${area.zoneName} - ${area.cityName}`;
    },
    cityLabel(city) {
      return `${city.cityName} - ${city.regionName}`;
    },

    zoneLabel(zone) {
      return `${zone.zoneName} - ${zone.cityName}`;
    },

    inputRemoveAreaHandle(area) {
      this.areaId = this.areaId.filter(item => item.areaId !== area.areaId);
      this.$forceUpdate()
    },
    inputAreaHandle(area) {

      const area1 = {
        areaId: area.areaId,
        areaName: area.name,
        zoneId: area.zoneId,
        cityId: area.cityId,
        regionId: area.regionId,
        cityName: area.cityName,
        zoneName: area.zoneName,
        selected: true
      };

      const areaIdIndex = this.searchItem(this.areaId, 'areaId', area.areaId)
      if (areaIdIndex === -1) {
        this.areaId.push(area1);
      }

      this.$forceUpdate()
    },
    searchItem(rows, key, value) {
      let rr = -1;
      rows.map((row, i) => {
        if (row[key] === value) {
          rr = i;
        }
      })
      return rr;
    },
    inputSelectRegion(event) {
    },


    regionCurrentRowHandle(event, region) {
      this.$forceUpdate();
    },
    getIds(rows, key) {
      let ids = [];
      rows.map((row) => {
        ids.push(row[key]);
      })
      return ids;
    },
    removeCitiesByRegion(region) {
      this.cities = this.cities.filter(item => item.regionId !== region.id);

      this.cityId = this.cityId.filter(item => item.regionId !== region.id);

      this.zones = this.zones.filter(item => item.regionId !== region.id);
      this.zoneId = this.zoneId.filter(item => item.regionId !== region.id);
      let area_items = this.areas.filter(item => item.regionId !== region.id);
      this.areas = area_items;
      this.areaId = area_items;

      this.$forceUpdate()
    },
    getCitiesByRegion(region) {


      const cities = this.cities;
      let citiesArray = [];
      this.getIds(this.regionId, 'id').map((value) => {
        let items = cities.filter(item => item.regionId === value);
        citiesArray = [...citiesArray, ...items];
      })
      this.cities = citiesArray;
      if (this.regionId.length > 0) {
        window.showLoader()
        axios.get(`/users/getRegionCity?region_id=${region.id}&userId=${this.userid}`)
            .then((response) => {
              /* this.cities = [];*/
              if (response.data.length > 0) {
                response.data.map((row) => {
                  const regionKey = this.searchItem(this.regions, 'id', region.id)
                  let cityKeyIndex = this.searchItem(this.cities, 'cityId', row.id);
                  if (cityKeyIndex === -1) {
                    this.cities.push({
                      cityId: row.id,
                      regionId: this.regions[regionKey].id,
                      cityName: row.name,
                      regionName: this.regions[regionKey].name,
                      selected: false
                    });
                  }
                  this.$forceUpdate()
                })
              } else {
                /*  this.cities = [];
                  this.areas = {};*/
                this.$forceUpdate();
              }
              window.hideLoader()
            });
      }
      //this.$refs.citiesRef.activate()
    },
    removeCityFromCities(city) {
      this.zones = this.zones.filter(item => item.cityId !== city.cityId);

      this.zoneId = this.zoneId.filter(item => item.cityId !== city.cityId);
      let area_items = this.areas.filter(item => item.cityId !== city.cityId);
      this.areas = area_items;
      this.areaId = area_items;

      this.forceUpdateStates();
    },
    forceUpdateStates() {
      try {
        this.$forceUpdate();
      } catch (e) {

      }
    },
    populateCitiesChange(city) {
      this.getIds(this.cityId, 'cityId').map((cityId) => {
        const cityKeyIndex = this.searchItem(this.cities, 'cityId', cityId);
        // this.cities[cityKeyIndex].selected = true;
        let regionCitiesKeyIndex = this.searchItem(this.cities, 'cityId', cityId);
        if (regionCitiesKeyIndex !== -1) {
          // this.cities[regionCitiesKeyIndex].selected = true;
        }
      })
      const zones = this.zones;
      let zoneArray = [];
      this.getIds(this.cityId, 'cityId').map((value) => {
        let items = zones.filter(item => item.cityId === value);
        zoneArray = [...zoneArray, ...items];
      })
      this.zones = zoneArray;
      this.forceUpdateStates();
      const {cityId, regionId, cityName} = city
      const cityKeyIndex = 1;// this.searchItem(this.cities, 'cityId', cityId);
      console.log(cityKeyIndex, 'ddd')
      if (cityKeyIndex) {
        //this.cities[cityKeyIndex].selected = !this.cities[cityKeyIndex].selected
        this.forceUpdateStates();
        window.showLoader()
        axios.get(`/users/getZone?city_id=${city.cityId}`)
            .then(response => {
              if (response.data.length > 0) {
                response.data.map((row) => {
                  let regionCitiesZoneKeyIndex = this.searchItem(this.zones, 'zoneId', row.id);
                  if (regionCitiesZoneKeyIndex === -1) {
                    this.zones.push({
                      zoneId: row.id,
                      zoneName: row.zoneName,
                      cityId: cityId,
                      cityName: cityName,
                      regionId: regionId,
                      selected: false
                    });
                  }
                })
              }
              this.forceUpdateStates();
              window.hideLoader()
            });
      }
      /* this.$refs.zoneRef.activate()*/

    },
    selectedCitiesHandle(event, city) {
      const {cityId, regionId, cityName} = city
      const cityKeyIndex = this.searchItem(this.cities, 'cityId', cityId);
      if (cityKeyIndex !== -1) {
        this.cities[cityKeyIndex].selected = !this.cities[cityKeyIndex].selected
        this.$forceUpdate();
        axios.get(`/users/getZone?city_id=${this.getIds(this.cityId, 'cityId')}`)
            .then(response => {
              if (response.data.length > 0) {
                response.data.map((row) => {
                  let regionCitiesZoneKeyIndex = this.searchItem(this.zones, 'zoneId', row.id);
                  if (regionCitiesZoneKeyIndex === -1) {
                    this.zones.push({
                      zoneId: row.id,
                      zoneName: row.zoneName,
                      cityId: cityId,
                      cityName: cityName,
                      regionId: regionId,
                      selected: false
                    });
                  }
                })
              }
              this.$forceUpdate();
            });
      }
    },
    zoneRemoveHandle(zone) {
      this.zoneId = this.zoneId.filter(item => item.zoneId !== zone.zoneId);
      let area_items = this.areas.filter(item => item.zoneId !== zone.zoneId);
      this.areas = area_items;
      this.areaId = area_items;
      this.$forceUpdate()
    },
    zoneChangeHandle(zone) {
      const areas = this.areas;
      let areaArray = [];
      this.getIds(this.zoneId, 'zoneId').map((value) => {
        let items = areas.filter(item => item.zoneId === value);
        areaArray = [...areaArray, ...items];
      })
      this.areas = areaArray;

      /*end  get selected zone areas lists */
      window.showLoader()
      axios.get(`/users/getArea?zone_id=${zone.zoneId}`)
          .then(response => {
            response.data.map((area) => {
              let regionCityZoneAreaIndex = this.searchItem(areas, 'areaId', area.id);
              if (regionCityZoneAreaIndex === -1) {
                const area1 = {
                  areaId: area.id,
                  areaName: area.name,
                  zoneId: zone.zoneId,
                  cityId: area.cityId,
                  regionId: zone.regionId,
                  cityName: zone.cityName,
                  zoneName: zone.zoneName,
                  selected: true
                };
                this.areas.push(area1);
                this.areaId.push(area1);
              }
            });
            this.$forceUpdate();
            window.hideLoader()
          });
      //this.$refs.areaRef.activate()

    }
  }
}
</script>


<style scoped>


</style>