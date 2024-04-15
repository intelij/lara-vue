<template>
  <section class="relative py-16 bg-blueGray-50">
    <!-- Modal for confirming deletion -->
    <div v-if="showDeleteModal" class="fixed inset-0 z-50 flex items-center justify-center overflow-x-hidden overflow-y-auto">
      <div class="fixed inset-0 bg-black opacity-25"></div>
      <div class="relative w-auto max-w-3xl mx-auto my-6 z-50">
        <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
          <div class="flex items-start justify-between p-5 border-b border-solid border-blueGray-200 rounded-t">
            <h3 class="text-3xl font-semibold text-black"> Confirm Deletion </h3>
            <button class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none" @click="showDeleteModal = false">
              <span class="bg-transparent text-black opacity-5 h-6 w-6 text-2xl block outline-none focus:outline-none"> × </span>
            </button>
          </div>
          <div class="relative p-6 flex-auto">
            <p class="my-4 text-blueGray-500 text-lg leading-relaxed text-black"> Are you sure you want to delete this task? </p>
          </div>
          <div class="flex items-center justify-end p-6 border-t border-solid border-blueGray-200 rounded-b">
            <button class="text-white bg-red-500 font-bold uppercase px-6 py-3 rounded outline-none focus:outline-none mr-1 mb-1" type="button" @click="confirmDelete(todoToDelete)"> Confirm </button>
            <button class="bg-blue-500 text-white font-bold uppercase px-6 py-3 rounded outline-none focus:outline-none mr-1 mb-1" type="button" @click="showDeleteModal = false"> Cancel </button>
          </div>
        </div>
      </div>
    </div>
    <!-- Todo Details Modal -->
    <TodoDetailsModal :todo="selectedTodo" :showModal="showTodoModal" @close="showTodoModal = false" />
    <div class="block w-full overflow-x-auto relative">
      <table class="items-center w-full bg-transparent border-collapse">
        <thead>
          <tr class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
            <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"> Title </th>
            <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"> Description </th>
            <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"> Status </th>
            <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"> Date Created </th>
            <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"> Actions </th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="todo in todos" :key="todo.id">
            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
              <a href="#" @click.prevent="showTodoDetails(todo)" class="text-blue-500 hover:text-blue-700">
                {{ todo.title }}
              </a>
            </td>
            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
              <div class="truncate" style="max-width: 200px;">
                {{ todo.description }}
              </div>
            </td>
            <td v-if="todo.completed != 1" class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"> Active </td>
            <td v-if="todo.completed == 1" class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"> Completed </td>
            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
              {{ formatDate(todo.created_at) }}
            </td>
            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
              <!-- v-if="todo.user_id == 2" -->
              <button @click="$emit('editTodo', todo)" class="bg-blue-500 text-white active:bg-blue-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1" type="button"> Edit </button>
              <button @click="showDeleteModal = true; todoToDelete = todo.id" class="bg-red-500 text-white active:bg-red-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1" type="button"> Delete </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </section>
</template>
<script>
  import TodoDetailsModal from './TodoDetailsModal.vue';
  export default {
    components: {
      TodoDetailsModal,
    },
    props: {
      todos: {
        type: Array,
        required: true,
      },
    },
    data() {
      return {
        showDeleteModal: false,
        todoToDelete: null,
        showTodoModal: false,
        selectedTodo: null,
      };
    },
    methods: {
      formatDate(dateString) {
        const options = {
          day: '2-digit',
          month: '2-digit',
          year: 'numeric',
          hour: '2-digit',
          minute: '2-digit'
        };
        return new Date(dateString).toLocaleString('en-GB', options);
      },
      confirmDelete(todoId) {
        this.$emit('deleteTodo', todoId);
        this.showDeleteModal = false;
      },
      showTodoDetails(todo) {
        this.selectedTodo = todo;
        this.showTodoModal = true;
      },
    },
  };
</script>
<style>
  .truncate {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }
</style>