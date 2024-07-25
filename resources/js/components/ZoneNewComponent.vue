<template>
  <div>
    <div class="row mt-3">
      <div class="col-md-6">
        <label class="form-label">Region<span class="req text-danger">*</span></label>
        <select multiple class="form-select" @change="getCitiesByRegion($event)" v-model="regionId">
          <option @click="regionCurrentRowHandle($event,{
             regionId: row.id
          })" v-for="row in regions" :value="row.id" :selected="(row.selected)">{{ row.name }}
          </option>
        </select>
      </div>
      <div class="col-md-6">
        <label class="form-label">City<span class="req text-danger">*</span></label>
        <select multiple class="form-select" v-model="cityId" @change="populateCitiesChange($event)" ref="cityRef">
          <option @click="selectedCitiesHandle($event,row)" v-for="row in cities" :value="row.cityId"
                  :selected="(row.selected)">{{ row.cityName }}
          </option>
        </select>
      </div>
    </div>
    <div class="pt-3 pb-3">
      <div v-for="(region,regionIndex) in zoneLists">
        <div v-if="region.cities.length >0" class="card no-border-mws mb-2">
          <div class="card-body">
            <div v-for="(city,cityIndex) in region.cities">
              <div class="card mb-2" v-if="city.zones && city.zones.length>0">
                <div class="card-header"><b>{{ city.cityName }}</b> - ({{ region.regionName }})</div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-6">
                      <label class="form-label">Select Zone <span class="req text-danger">*</span></label>
                      <select multiple class="form-select custom-select-mws1"
                              @change="zoneChangeHandle($event,city.cityId,region.regionId,regionIndex,cityIndex)"
                              v-model="zoneIds">
                        <option @click="selectZoneHandle($event,zone,region,city,regionIndex,cityIndex,zoneIndex)"
                                v-for="(zone,zoneIndex) in city.zones" :value="zone.zoneId" :selected="zone.selected">
                          {{ zone.zoneName }}
                        </option>
                      </select>
                    </div>
                    <div class="col-lg-6 mt-1">
                      <div v-if="areas[city.cityId]?.length>0">
                        <label class="form-label">Select Area <span class="req text-danger">*</span></label>
                        <select multiple class="form-select custom-select-mws1" v-model="areaIds">
                          <option v-for="(area,areaIndex) in areas[city.cityId]" :value="area.areaId"
                                  :selected="area.selected">{{ area.areaName }} ({{ area.zoneName }} -
                            {{ area.cityName }} )
                          </option>
                        </select>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      {{ JSON.stringify(zoneLists) }}
      <hr>
      {{ JSON.stringify(areas) }}
    </div>
  </div>
</template>

<script>
import axios from "axios";
import {ref} from 'vue'

export default {
  components: {},
  name: 'ZoneNewComponent',
  setup() {
    const cityRef = ref(null);
    return {
      cityRef
    }
  },
  props: ['regions'],
  data() {
    return {
      regionId: '',
      cityId: '',
      zoneIds: '',
      areaIds: '',
      cities: [],
      areas: {},
      zoneLists: [],
      emptyZoneRegion: {},
      emptyZoneCity: {},
    }
  },
  computed: {
    /* isZoneExist(regionIndex,cityIndex){
       return true;
       return this.isZoneExistByCity(regionIndex,cityIndex)
     }*/
  },
  watch: {
    zoneLists: function () {
      this.zoneLists.map((region) => {
        if (region.cities.length === 0) {
          this.emptyZoneRegion[region.regionId] = true
        } else {
          this.emptyZoneRegion[region.regionId] = false
        }
        region.cities.map((city) => {
          if (city.zones.length === 0) {
            this.emptyZoneCity[city.cityId] = true
          } else {
            this.emptyZoneCity[city.cityId] = false
          }
        })
      })
    }
  },
  methods: {
    findByItems(items, key, rows) {
      let ii = [];
      rows.map((row, i) => {
        let regionExist = this.searchItem(items, key, row);
        if (items[regionExist]) {
          ii.push(items[regionExist])
        }
      })
      return ii;
    },

    isZoneExistByCity(regionIndex, cityIndex) {
      return true
      /*  try {
          return this.zoneLists[regionIndex].length &&
              this.zoneLists[regionIndex].cities[cityIndex].length &&
              this.zoneLists[regionIndex].cities[cityIndex].zones.length &&
              this.zoneLists[regionIndex].cities[cityIndex].zones.length === 0
        }
        catch (e) {
          return false;
        }*/
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
    emptyRow(row) {
      if (Object.keys(row).length > 0) {
        return true
      }
      return false;
    },
    getCitiesByRegion(event) {
      // this.zoneLists = []
      this.regionId.map((regionId, i) => {
        let regionExist = this.searchItem(this.zoneLists, 'regionId', regionId);
        let regionKeyIndex = this.searchItem(this.regions, 'id', regionId);
        const regionName = this.regions[regionKeyIndex].name ?? '';
        if (regionExist === -1) {
          this.zoneLists.push({
            regionId: regionId,
            regionName: regionName,
            selected: true,
            cities: []
          });
        }
        this.cityId = '';
        this.$forceUpdate();
      })
      if (this.regionId.length > 0) {
        axios.get(`/users/getRegionCity?region_id=${this.regionId}`)
            .then((response) => {
             /* this.cities = [];*/
              if (response.data.length > 0) {
                response.data.map((row, i) => {
                  let regionKeyIndex = this.searchItem(this.zoneLists, 'regionId', row.regionId);
                  let cityKeyIndex = this.searchItem(this.cities, 'cityId', row.id);
                  if (cityKeyIndex === -1){
                    this.cities.push({
                      cityId: row.id,
                      regionId: row.regionId,
                      cityName: row.name,
                      selected: false
                      /* cities:this.zoneLists[regionKeyIndex].cities??[] */
                    });
                  } else {
                    this.cities[cityKeyIndex] ={
                      cityId  : this.cities[cityKeyIndex]?.cityId??row.id,
                      regionId: this.cities[cityKeyIndex]?.regionId??row.regionId,
                      cityName: this.cities[cityKeyIndex]?.cityName??row.name,
                      selected: this.cities[cityKeyIndex].selected??false
                    };
                  }
                  this.$forceUpdate()
                })
              } else {
                this.cities = [];
                this.$forceUpdate();
              }
            });
      }
    },
    populateCitiesChange(event) {
      this.cityId.map((cityId, index) => {
        const cityKeyIndex = this.searchItem(this.cities, 'cityId', cityId);
        this.cities[cityKeyIndex].selected = true;
        const city = this.cities[cityKeyIndex];
        const regionId = city.regionId;
        let regionKeyIndex = this.searchItem(this.zoneLists, 'regionId', regionId);
        let regionCitiesKeyIndex = this.searchItem(this.cities, 'cityId', cityId);
        let regionCityKeyIndex = this.searchItem(this.zoneLists[regionKeyIndex].cities, 'cityId', cityId);
        if (regionCityKeyIndex === -1) {
          this.zoneLists[regionKeyIndex].cities.push(city);
        }
        if (regionCitiesKeyIndex !== -1){
          this.cities[regionCitiesKeyIndex].selected=true;
        }
        this.$forceUpdate();
      })
    },
    selectedCitiesHandle(event, city) {
      const regionId = city.regionId;
      const cityId = city.cityId;

      console.log(JSON.stringify(this.zoneLists))
      const unselectedOption = this.cityId.find(option => {
        return option === cityId;
      });
      const newItems = this.findByItems(this.zoneLists, 'regionId', this.regionId)
      newItems.map((region, ri) => {
        this.zoneLists[ri].cities = this.findByItems(region.cities, 'cityId', this.cityId);
      })
      let regionKeyIndex = this.searchItem(this.zoneLists, 'regionId', regionId);
      let regionCityKeyIndex = this.searchItem(this.zoneLists[regionKeyIndex].cities, 'cityId', cityId);
      /*if (unselectedOption ===undefined){
        if (regionCityKeyIndex !==-1){
         // this.zoneLists[regionKeyIndex].cities.splice(regionCityKeyIndex,1)
        }
      } else {

      }*/
      if (this.cityId.length > 0 && regionCityKeyIndex !== -1) {
        this.zoneLists[regionKeyIndex].cities[regionCityKeyIndex].zones = [];
        const zones = this.zoneLists[regionKeyIndex]?.cities[regionCityKeyIndex]?.zones ?? [];
        axios.get(`/users/getZone?city_id=${cityId}`)
            .then(response => {
              if (response.data.length > 0) {
                response.data.map((row, i) => {
                  let regionCitiesZoneKeyIndex = this.searchItem(zones, 'zoneId', row.id);
                  if (regionCitiesZoneKeyIndex === -1) {
                    this.zoneLists[regionKeyIndex].cities[regionCityKeyIndex].zones.push({
                      zoneId: row.id,
                      zoneName: row.zoneName,
                      cityId: cityId,
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
    regionCurrentRowHandle(event, region) {

      const regionId = region.regionId;
      const unselectedOption = this.regionId.find(option => {
        return option === regionId;
      });

      const newItems = this.findByItems(this.zoneLists, 'regionId', this.regionId)
      let regionKeyIndex = this.searchItem(this.zoneLists, 'regionId', regionId);
      this.zoneLists = newItems;
      /*console.log(JSON.stringify(newItems),region,'newItems')
      if (unselectedOption ===undefined){
        if (regionKeyIndex !==-1){
          this.zoneLists.splice(regionKeyIndex,1)
        }
      }*/
      this.$forceUpdate();
    },
    selectZoneHandle(event, zone, region, city, regionIndex, cityIndex, zoneIndex) {
      this.zoneSelectedHandle(zone);
      this.areas[city.cityId] = this.areas[city.cityId] ?? [];
      const areas = this.areas[city.cityId];
      if (this.zoneIds.length > 0) {
        /* start get selected zone areas lists */
        let areasNew = [];
        this.zoneIds.map((zoneId) => {
          let items = areas.filter(item => item.zoneId === zoneId);
          areasNew = [...areasNew, ...items];
        })
        this.areas[city.cityId] = areasNew;
        /*end  get selected zone areas lists */
        axios.get(`/users/getArea?zone_id=${zone.zoneId}`)
            .then(response => {
              response.data.map((area, i) => {
                let regionCityZoneAreaIndex = this.searchItem(areas, 'areaId', area.id);
                if (regionCityZoneAreaIndex === -1) {
                  this.areas[city.cityId].push({
                    areaId: area.id,
                    areaName: area.name,
                    zoneId: zone.zoneId,
                    cityId: city.cityId,
                    regionId:region.regionId,
                    cityName: city.cityName,
                    zoneName: zone.zoneName,
                    selected: true
                  });
                }
              });
              this.$forceUpdate();
            });
      }
    },

    zoneSelectedHandle(zoneCurrent) {
      const newItems = this.findByItems(this.zoneLists, 'regionId', this.regionId)
      newItems.map((region, ri) => {
        const newItemCities = this.findByItems(region.cities, 'cityId', this.cityId)
        newItemCities.map((city, ci) => {
          region.cities[ci].zones.map((zone, zi) => {
            this.zoneLists[ri].cities[ci].zones[zi].selected = false
          })
        })
      })
      const newItems1 = this.findByItems(this.zoneLists, 'regionId', this.regionId)
      newItems1.map((region, ri) => {
        const newItemCities = this.findByItems(region.cities, 'cityId', this.cityId)
        newItemCities.map((city, ci) => {
          const newItemZones = this.findByItems(region.cities[ci].zones, 'zoneId', this.zoneIds)
          newItemZones.map((zone, zzi) => {
            const zoneIndex = this.searchItem(region.cities[ci].zones, 'zoneId', zone.zoneId)
            this.zoneLists[ri].cities[ci].zones[zoneIndex].selected = true
          })
        })
      })
      this.$forceUpdate();
    },

    zoneChangeHandle(event, cityId, regionId, regionIndex, cityIndex) {
      const city = this.zoneLists[regionIndex].cities[cityIndex];
      this.zoneIds.map((zoneId, i) => {
        const zoneIndex = this.searchItem(city.zones, 'zoneId', zoneId);
      });
    }
  }
}
</script>


<style scoped>
.no-border-mws {
  border: none;
}

.no-border-mws > .card-body {
  padding: 0
}
.custom-select-mws1{
  height: 350px;
}
</style>