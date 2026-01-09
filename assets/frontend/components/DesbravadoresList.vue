<template>
  <div>
    <h1>Gerenciar Desbravadores</h1>
    <router-link to="/adicionar" class="btn btn-success">Adicionar Desbravador</router-link>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Nome Completo</th>
          <th>Unidade</th>
          <th>Classe Base</th>
          <th>Cargo</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="d in desbravadores" :key="d.id_desbravador">
          <td>{{ d.nome_completo }}</td>
          <td>{{ d.nome_unidade || 'Sem unidade' }}</td>
          <td>{{ d.classe_base || '-' }}</td>
          <td>{{ d.cargo }}</td>
          <td>
            <router-link :to="'/editar/' + d.id_desbravador" class="btn btn-warning">Editar</router-link>
            <button @click="deletar(d.id_desbravador)" class="btn btn-danger">Excluir</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return { desbravadores: [] };
  },
  mounted() {
    this.loadData();
  },
  methods: {
    loadData() {
      axios.get('/api/desbravadores').then(res => {
        this.desbravadores = res.data;
      });
    },
    deletar(id) {
      if (confirm('Tem certeza?')) {
        axios.delete(`/api/desbravadores/${id}`).then(() => {
          this.loadData();
          alert('Excluído com sucesso!');
        }).catch(err => alert(err.response.data.erro || 'Erro ao excluir'));
      }
    },
  },
};
</script>