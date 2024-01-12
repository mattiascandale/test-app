<template>
  <main>
    <div class="container">
      <div class="card mt-2">
        <div class="card-header"><strong>Nuovo</strong></div>
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
          <div
            v-if="this.success == true"
            class="alert alert-success"
            role="alert"
          >
            Persona inserita con successo
          </div>
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

export default {
  name: "peopleCreate",
  data() {
    return {
      errors: "",
      success: false,
      model: {
        name: "",
        surname: "",
        birth_date: "",
      },
    };
  },
  methods: {
    savePeople() {
      let self = this;
      axios
        .post(this.$api_url + "/api/people", this.model)
        .then((result) => {
          self.success = true;
          self.model = [];
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
