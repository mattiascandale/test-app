<template>
  <div class="card mt-2">
    <div class="card-header">
      <strong>{{ headerTitle }}</strong>
      <RouterLink class="btn btn-primary btn-sm float-end" to="/people">
        <i class="bi bi-arrow-90deg-left"></i>
      </RouterLink>
    </div>
    <div class="card-body">
      <form @submit.prevent="submit">
        <div v-if="this.success" class="alert alert-success" role="alert">
          {{ this.message ? this.message : "" }}
        </div>
        <div class="mb-3">
          <label :class="{ 'text-danger': this.errors.name }">
            Nome<small class="text-danger">*</small>
          </label>
          <input
            :class="{ 'is-invalid': this.errors.name }"
            v-model="model.name"
            type="text"
            class="form-control"
            placeholder="Nome"
          />
          <div class="invalid-feedback" v-if="this.errors.name">
            {{ this.errors.name ? this.errors.name[0] : "" }}
          </div>
        </div>
        <div class="mb-3">
          <label :class="{ 'text-danger': this.errors.surname }">
            Cognome<small class="text-danger">*</small>
          </label>
          <input
            :class="{ 'is-invalid': this.errors.surname }"
            v-model="model.surname"
            type="text"
            class="form-control"
            placeholder="Cognome"
          />
          <div class="invalid-feedback" v-if="this.errors.name">
            {{ this.errors.surname ? this.errors.surname[0] : "" }}
          </div>
        </div>
        <div class="mb-3">
          <label :class="{ 'text-danger': this.errors.birth_date }">
            Data di nascita<small class="text-danger">*</small>
          </label>
          <input
            :class="{ 'is-invalid': this.errors.surname }"
            v-model="model.birth_date"
            type="date"
            class="form-control"
          />
          <div class="invalid-feedback" v-if="this.errors.birth_date">
            {{ this.errors.birth_date ? this.errors.birth_date[0] : "" }}
          </div>
        </div>
        <div class="mb-3">
          <label :class="{ 'text-danger': this.errors.email }">Email</label>
          <input
            :class="{ 'text-danger': this.errors.email }"
            v-model="model.email"
            type="text"
            class="form-control"
            placeholder="Email"
          />
          <div class="invalid-feedback" v-if="this.errors.email">
            {{ this.errors.email ? this.errors.email[0] : "" }}
          </div>
        </div>
        <div class="mb-3">
          <label :class="{ 'text-danger': this.errors.phone }">Cellulare</label>
          <input
            :class="{ 'text-danger': this.errors.phone }"
            v-model="model.phone"
            type="text"
            class="form-control"
            placeholder="Cellulare"
          />
        </div>
        <div class="invalid-feedback" v-if="this.errors.phone">
          {{ this.errors.phone ? this.errors.phone[0] : "" }}
        </div>
        <div class="mb-3">
          <button type="submit" class="btn btn-success">Salva</button>
        </div>
      </form>
    </div>
  </div>
</template>
<script>
export default {
  props: ["headerTitle", "data", "errors", "success", "message"],
  data() {
    return {
      model: {},
    };
  },

  mounted() {
    this.model = this.data;
  },

  watch: {
    data: {
      handler(newData) {
        this.model = newData;
      },
      immediate: true,
    },
  },

  methods: {
    submit() {
      this.$emit("formSubmit", this.model);
    },
  },
};
</script>
