<template>
  <div>
    <h1>{{ id ? 'Editar' : 'Adicionar' }} Desbravador</h1>
    <form @submit.prevent="salvar">
      <div class="form-group">
        <label>Nome Completo</label>
        <input v-model="form.nome_completo" class="form-control" required minlength="5">
      </div>
      <div class="form-group">
        <label>Unidade</label>
        <select v-model="form.id_unidade" class="form-control" required>
          <option v-for="u in unidades" :key="u.id_unidade" :value="u.id_unidade">{{ u.nome_unidade }}</option>
        </select>
      </div>
      <div class="form-group">
        <label>Cargo</label>
        <input v-model="form.cargo" class="form-control">
      </div>
      <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  props: ['id'],
  data() {
    return {
      form: { nome_completo: '', id_unidade: '', cargo: 'Membro' },
      unidades: [],
    };
  },
  mounted() {
    this.loadUnidades();
    if (this.id) this.loadData();
  },
  methods: {
    loadUnidades() {
      axios.get('/api/unidades').then(res => {
        this.unidades = res.data;
      });
    },
    loadData() {
      axios.get(`/api/desbravadores/${this.id}`).then(res => {
        this.form = res.data;
      });
    },
    salvar() {
      const method = this.id ? 'put' : 'post';
      const url = this.id ? `/api/desbravadores/${this.id}` : '/api/desbravadores';
      axios[method](url, this.form).then(() => {
        alert('Salvo com sucesso!');
        this.$router.push('/');
      }).catch(err => alert('Erro: ' + Object.values(err.response.data.errors).flat().join(', ')));
    },
  },
};
</script>