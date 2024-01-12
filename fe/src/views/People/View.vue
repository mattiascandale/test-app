<template>
  <main>
    <div class="container">
      <div class="card mt-2">
        <div class="card-header">
          <RouterLink class="btn btn-success btn-sm float-end" to="/people/new"
            ><i class="bi bi-plus-lg"></i
          ></RouterLink>
        </div>
        <div class="card-body">
          <table class="table table-bordered table-sm">
            <thead>
              <tr>
                <th scope="col"><strong>Cognome</strong></th>
                <th scope="col"><strong>Nome</strong></th>
                <th scope="col"><strong>Data di nascita</strong></th>
                <th scope="col"><strong>Email</strong></th>
                <th scope="col"><strong>Telefono</strong></th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody v-if="this.people.length > 0">
              <tr v-for="(person, index) in this.people" :key="index">
                <td>{{ person.surname }}</td>
                <td>{{ person.name }}</td>
                <td>{{ formatDate(person.birth_date) }}</td>
                <td>{{ person.email }}</td>
                <td>{{ person.phone }}</td>
                <td class="col-sm-1">
                  <div class="btn-group d-flex" role="group">
                    <button
                      class="btn btn-outline-danger btn-sm"
                      @click="deletePeople(person.id)"
                    >
                      <i class="bi bi-trash-fill"></i>
                    </button>
                    <RouterLink
                      class="btn btn-outline-primary btn-sm"
                      :to="{ path: '/people/' + person.id + '/edit' }"
                      ><i class="bi bi-pencil"></i
                    ></RouterLink>
                  </div>
                </td>
              </tr>
            </tbody>
            <tbody v-else>
              <tr>
                <td v-if="this.httpStatus !== 200" colspan="6">
                  <i class="bi bi-database-fill-x"></i> Dati non presenti in archivio
                </td>
                <td v-else colspan="6">
                  <div class="spinner-grow spinner-grow-sm"></div>
                  Caricamento in corso ...
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </main>
</template>

<script>
import axios from "axios";
import moment from "moment";
import { RouterLink } from "vue-router";

export default {
  name: "people",
  data() {
    return {
      httpStatus: 200,
      people: [],
    };
  },
  mounted() {
    this.getPeople();
  },
  methods: {
    formatDate(date) {
      return moment(date).format("DD/MM/YYYY");
    },
    getPeople() {
      self = this;
      axios
        .get(this.$api_url + "/api/people")
        .then((result) => {
          this.people = result.data;
        })
        .catch(function (error) {
          self.httpStatus = error.response.status;
        });
    },

    deletePeople(id) {
      if (confirm("Sei sicuro di voler rimuovere la persona ?")) {
        axios.delete(this.$api_url + `/api/people/${id}`).then((result) => {
          this.getPeople();
        });
      }
    },
  },
  components: { RouterLink },
};
</script>
