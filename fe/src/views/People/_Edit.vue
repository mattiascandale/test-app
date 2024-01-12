<template>
  <main>
    <div class="container">
      <div class="card mt-2">
        <div class="card-header"><strong>Modifica</strong></div>
        <div class="card-body">
          <ul
            class="alert alert-warning"
            v-if="Object.keys(this.errors).length > 0"
          >
            <h6>Si sono verificati degli errori:</h6>
            <li
              class="mb-0 ms-3"
              v-for="(error, index) in this.errors"
              :key="index"
            >
              {{ error }}
            </li>
          </ul>
          <div class="mb-3">
            <label>Nome</label>
            <input
              v-model="model.name"
              type="text"
              class="form-control"
              placeholder="Nome"
            />
          </div>
          <div class="mb-3">
            <label>Cognome</label>
            <input
              v-model="model.surname"
              type="text"
              class="form-control"
              placeholder="Cognome"
            />
          </div>
          <div class="mb-3">
            <label>Data di nascita</label>
            <input
              v-model="model.birth_date"
              type="date"
              class="form-control"
            />
          </div>
          <div class="mb-3">
            <button type="button" class="btn btn-success" @click="savePeople">
              Salva
            </button>
          </div>
        </div>
      </div>
    </div>
  </main>
</template>

<script>
import axios from "axios";
import router from "@/router";

export default {
  name: "peopleEdit",
  data() {
    return {
      id: "",
      errors: "",
      model: {
        name: "",
        surname: "",
        birth_date: "",
      },
    };
  },
  mounted() {
    this.id = this.$route.params.id;
    this.getPeople(this.$route.params.id);
    console.log(this.$router.currentRoute);
  },
  methods: {
    getPeople(id) {
      let self = this;
      axios
        .get(`http://localhost:8000/api/people/${id}`)
        .then((result) => {
          this.model = result.data;
        })
        .catch(function (error) {
          if (error.response.status == 404) {
            self.$router.push({path: "/people"});
          }
        });
    },
    savePeople(id) {
      var self = this;
      axios
        .put(`http://localhost:8000/api/people/${this.id}`, this.model)
        .then((result) => {
          console.log(result.data);
        })
        .catch(function (error) {
          if (error.response.status !== 200) {
            self.errors = error.response.data.error;
          }
        });
    },
  },
};
</script>
