<template>
  <main>
    <div class="container">
      <person-data-form
        headerTitle="Modifica"
        :errors="errors"
        :success="success"
        :message="message"
        @formSubmit="handleSubmit"
        :data="model"
        v-if="model"
      >
      </person-data-form>
    </div>
  </main>
</template>

<script>
import axios from "axios";
import PersonDataForm from "../../components/PersonDataForm.vue";
import router from "@/router";

export default {
  name: "peopleEdit",
  components: { PersonDataForm },
  data() {
    return {
      id: "",
      errors: "",
      model: "",
      success: "",
      message: ""
    };
  },
  mounted() {
    this.id = this.$route.params.id;
    this.getPeople(this.$route.params.id);
  },
  methods: {
    handleSubmit(data) {
      this.savePeople(data);
    },

    getPeople(id) {
      let self = this;
      axios
        .get(this.$api_url + `/api/people/${id}`)
        .then((result) => {
          this.model = result.data;
        })
        .catch(function (error) {
          if (error.response.status == 404) {
            self.$router.push({ path: "/people" });
          }
        });
    },
    savePeople() {
      var self = this;
      axios
        .put(this.$api_url + `/api/people/${this.id}`, this.model)
        .then((result) => {
          self.success = true;
          self.message = 'Persona modificata con successo';
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
