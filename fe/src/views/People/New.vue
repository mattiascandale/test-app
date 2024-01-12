<template>
  <main>
    <div class="container">
      <person-data-form
        headerTitle="Nuovo"
        :errors="errors"
        :success="success"
        :message="message"
        @formSubmit="handleSubmit"
        :data="model"
      >
      </person-data-form>
    </div>
  </main>
</template>

<script>
import axios from "axios";
import PersonDataForm from "../../components/PersonDataForm.vue";

export default {
  name: "peopleCreate",
  components: { PersonDataForm},
  data() {
    return {
      loading: false,
      errors: "",
      success: false,
      message: "",
      model: {},
    };
  },
  methods: {
    handleSubmit(data) {
      this.savePeople(data);
    },

    savePeople(data) {
      let self = this;
      axios
        .post(this.$api_url + "/api/people", data)
        .then((result) => {
          self.success = true;
          self.message = "Persona inserita con successo";
          this.model = {};
        })
        .catch(function (error) {
          if (error.response.status !== 200) {
            self.errors = error.response.data.errors;
          }
        });
    },
  },
};
</script>
