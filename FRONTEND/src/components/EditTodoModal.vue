<template>
  <div v-if="showModal"
    class="fixed inset-0 z-50 overflow-auto bg-black bg-opacity-50 flex items-center justify-center">
    <div class="relative bg-white w-1/2 p-8 rounded-lg">
      <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-semibold text-gray-900">Edit Todo</h2>
        <button @click="$emit('closeModal')" class="text-gray-500 hover:text-gray-700">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
      <form @submit.prevent="$emit('updateTodo', editedTodo)">
        <div class="mb-4">
          <label for="edit-title" class="block text-sm font-medium text-gray-700">Title</label>
          <input v-model="editedTodo.title" type="text" name="edit-title" id="edit-title"
            class="mt-1 p-2 block w-full border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" />
        </div>
        <div class="mb-4">
          <label for="edit-description" class="block text-sm font-medium text-gray-700">Description</label>
          <textarea v-model="editedTodo.description" id="edit-description" name="edit-description" rows="3"
            class="mt-1 p-2 block w-full border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" />
        </div>
        <div class="mb-4">
          <label for="edit-completed" class="block text-sm font-medium text-gray-700">Status</label>
          <select v-model="editedTodo.completed" id="edit-completed" name="edit-completed"
            class="mt-1 p-2 block w-full border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
            <option value="0">Pending</option>
            <option value="1">Completed</option>
          </select>
        </div>
        <div class="flex justify-end">
          <button type="button" @click="$emit('closeModal')"
            class="mr-2 bg-gray-200 text-gray-800 hover:bg-gray-300 font-semibold py-2 px-4 rounded focus:outline-none focus:ring focus:ring-gray-300">
            Cancel
          </button>
          <button type="submit"
            class="bg-indigo-500 text-white hover:bg-indigo-600 font-semibold py-2 px-4 rounded focus:outline-none focus:ring focus:ring-indigo-300">
            Save
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    showModal: {
      type: Boolean,
      required: true,
    },
    editedTodo: {
      type: Object,
      required: true,
    },
  },
};
</script>