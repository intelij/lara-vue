<template>
  <div class="relative addtododiv">
    <section class="bg-blueGray-50">
      <div class="w-full px-4 py-8">
        <div class="relative flex flex-col min-w-0 break-words w-full shadow-lg rounded text-black">
          <div class="rounded-t mb-0 px-4 py-3 border-0 flex items-center justify-between">
            <h3 class="font-semibold text-lg text-white">{{ authUser ? authUser.name + ' Todos' : 'User Todos' }}</h3>
            <button @click="openModal"
              class="bg-green-500 text-white active:bg-emerald-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none"
              type="button">
              Add Todo
            </button>
          </div>
          <TodoList :todos="todos" @deleteTodo="deleteTodo" @editTodo="editTodoModal" class="todolistdiv" />
        </div>
      </div>
      <AddTodoModal :showModal="showModal" @closeModal="closeModal" @createTodo="createTodo" />
      <EditTodoModal :showModal="showEditModal" :editedTodo="editedTodo" @closeModal="closeEditModal"
        @updateTodo="updateTodo" />
    </section>
  </div>
</template> 

<script>
import axios from 'axios';
import TodoList from './TodoList.vue';
import AddTodoModal from './AddTodoModal.vue';
import EditTodoModal from './EditTodoModal.vue';
import { useAuthStore } from '../stores/auth';

export default {
  components: {
    TodoList,
    AddTodoModal,
    EditTodoModal,
  },
  data() {
    return {
      todos: [],
      showModal: false,
      showEditModal: false,
      editedTodo: {},
      authUser: null, //
    };
  },
  mounted() {
    this.fetchTodos();
    this.getAuthUser();
  },
  methods: {
    deleteTodo(id) {
      axios.delete(`/api/todos/${id}`)
        .then(() => {
          this.fetchTodos();
        })
        .catch(error => {
          console.error('Error deleting todo:', error);
        });
    },
    editTodoModal(todo) {
      this.editedTodo = { ...todo };
      this.showEditModal = true;
    },
    closeEditModal() {
      this.showEditModal = false;
    },
    updateTodo(updatedTodo) {
      axios.put(`/api/todos/${updatedTodo.id}`, updatedTodo)
        .then(() => {
          this.fetchTodos();
          this.closeEditModal();
        })
        .catch(error => {
          console.error('Error updating todo:', error);
        });
    },
    fetchTodos() {
      axios.get('/api/todos')
        .then(response => {
          this.todos = response.data.todos;
        })
        .catch(error => {
          console.error('Error fetching todos:', error);
        });
    },
    openModal() {
      this.showModal = true;
    },
    closeModal() {
      this.showModal = false;
    },
    createTodo(newTodo) {
      axios.post('/api/todos', newTodo)
        .then(response => {
          this.todos.push(response.data.todo);
          this.closeModal();
        })
        .catch(error => {
          console.error('Error creating todo:', error);
        });
    },
    getAuthUser() {
      const authStore = useAuthStore();
      authStore.getUser().then(() => {
        this.authUser = authStore.user;
      });
    },
  },
};
</script>

<style scoped>
.addtododiv {
  padding: 60px;
  padding-left: 10px;
  padding-right: 10px;
}

.todolistdiv {
  padding-top: 10px;
}
</style>