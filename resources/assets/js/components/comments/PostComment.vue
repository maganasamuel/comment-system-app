<template>
  <div class="flex space-x-3">
    <div class="flex-shrink-0">
      <div class="relative">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="h-10 w-10 rounded-full text-gray-400 flex items-center justify-center ring-8 ring-white"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"
          />
        </svg>

        <span class="absolute -bottom-0.5 -right-1 bg-white rounded-tl px-0.5 py-px">
          <!-- Heroicon name: solid/chat-alt -->
          <svg
            class="h-5 w-5 text-gray-400"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 20 20"
            fill="currentColor"
            aria-hidden="true"
          >
            <path
              fill-rule="evenodd"
              d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z"
              clip-rule="evenodd"
            />
          </svg>
        </span>
      </div>
    </div>
    <div class="min-w-0 flex-1">
      <form @submit.prevent="postComment">
        <div>
          <label
            for="comment"
            class="sr-only"
          >User
            Name</label>
          <input
            v-model="state.user_name"
            type="text"
            id="user_name"
            name="user_name"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            placeholder="What's your name?"
          >
          <p
            class="text-sm text-red-600 mt-1"
            v-show="errors.user_name"
          >{{ errors.user_name }}</p>
        </div>
        <div class="mt-3">
          <label
            for="comment"
            class="sr-only"
          >Comment</label>
          <textarea
            v-model="state.message"
            id="comment"
            name="comment"
            rows="3"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            placeholder="Leave a comment"
          ></textarea>
          <p
            class="text-sm text-red-600 mt-1"
            v-show="errors.message"
          >{{ errors.message }}</p>
        </div>
        <div class="mt-1 flex items-center justify-end space-x-4">
          <button
            type="submit"
            class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-gray-900 hover:bg-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900"
          >
            Comment
          </button>
        </div>
      </form>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      state: {
        user_name: "",
        message: "",
      },
      errors: {},
    };
  },
  methods: {
    postComment() {
      this.errors = {};

      axios
        .post("/api/comments", this.state)
        .then((response) => {
          this.$emit("posted", response.data.data);

          this.state.user_name = "";
          this.state.message = "";
        })
        .catch((error) => {
          this.errors = _.mapValues(
            error.response.data.errors,
            (value) => value[0]
          );
        });
    },
  },
};
</script>
