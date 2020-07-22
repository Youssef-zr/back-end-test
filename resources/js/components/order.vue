<template>
  <div class="order mt-4">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="jumbotron">
            <a href="/" class="btn btn-secondary">Home page</a>

            <div class="col-md-6 offset-md-3">
              <h2 class="text-center text-capitalize text-muted">choose your order now</h2>

               <div class="alert alert-danger my-3 text-center" role="alert" v-if="validation!=''">
                  <strong>{{validation}}</strong>
                </div>

              <div class="form-group">
                <label for class="form-label">choose city</label>
                <br />
                <select class="form-control" v-model="city_id">
                  <option v-for="city in cities.data" :key="city.id" :value="city.id">{{city.name}}</option>
                </select>
              </div>

              <div class="form-group">
                <label for class="form-label">date to recieve order</label>
                <input type="date" name id class="form-control" v-model="date" />
              </div>

              <div class="form-group">
                <label for class="form-label">check the available delivery times</label>
                <br />
                <button class="btn btn-primary" @click="checkOrder">check</button>
              </div>

              <div class="result">

                <div class="image my-2 text-center my-2" v-if="loading">
                  <img src="../img/loading.gif" alt />
                </div>

                <div class="alert alert-danger my-3 text-center" role="alert" v-if="err!=''">
                  <strong>{{err}}</strong>
                </div>

                <div v-if="deleveryTimes!=''">
                  <table
                    class="table table-striped table-inverse table-responsive text-center bg-white"
                  >
                    <thead class="thead-inverse">
                      <tr>
                        <th>Day Name</th>
                        <th>date</th>
                        <th>delevery available</th>
                        <th>nbDaysOfOrder</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(item, index) in deleveryTimes" :key="index">
                        <td>{{ item.day_name }}</td>
                        <td>{{ item.date }}</td>
                        <td>{{ item.delivery_times.delevery_at }}</td>
                        <td>{{ item.nbDaysOfOrder==2?'tomorrow':item.nbDaysOfOrder==0?'some ours':item.nbDaysOfOrder==1?'Today':item.nbDaysOfOrder+' Days'}}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      date: null,
      city_id: null,
      cities: [],
      deleveryTimes: [],
      loading: false,
      err: "",
      validation: ""
    };
  },
  created() {
    this.get_cities();
  },
  methods: {
    checkOrder: function() {
      if (this.date == null || this.city_id == null) {
        this.validation = "please choose a city and select a date";
      } else {
        this.validation = "";
      }

      if (this.date != null && this.city_id != null) {
        this.loading = true;
        this.err = "";
        axios
          .get(
            `/GET/api/cities/${this.city_id}/delivery-dates-times/${this.date}`
          )
          .then(response => {
            console.log(response.data.dates);
            this.deleveryTimes = response.data.dates;
            this.loading = false;
          })
          .catch(err => {
            if (err.response.data.msg != undefined) {
              this.err = err.response.data.msg;
              this.deleveryTimes = [];
            }
            this.loading = false;
          });
      }
    },
    get_cities() {
      axios
        .get("/cities/get")
        .then(response => {
          this.cities = response.data;
        })
        .catch(err => {
          console.log(err.message);
        });
    }
  }
};
</script>
