<template>
  <li>
    <div class="relative pb-8">
      <span
        class="absolute top-5 left-5 -ml-px h-full w-0.5 bg-gray-200"
        aria-hidden="true"
      ></span>
      <div class="relative flex items-start space-x-3">
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
        <div class="min-w-0 flex-1">
          <div>
            <div class="text-sm">
              <a
                href="#"
                class="font-medium text-gray-900"
              >{{ comment.user_name }}</a>
            </div>
            <p class="mt-0.5 text-xs text-gray-500">
              Commented
              {{ comment.created_at }}
            </p>
          </div>
          <div class="mt-2 text-sm text-gray-700">
            <p>{{ comment.message }}</p>
          </div>

          <template v-if="comment.layer < $root.maxCommentLayer">
            <reply-comment
              :parent-id="comment.id"
              @replied="replied"
            ></reply-comment>
            <div
              v-show="comment.children - 0 > 0 || list.length > 0"
              class="flow-root mt-2"
            >
              <button
                type="button"
                class="px-2 py-1 text-xs font-bold text-gray-900"
                @click="viewReplies"
              >View replies</button>
              <ul
                v-show="showList"
                class="mt-6"
              >
                <comment-item
                  v-for="(comment, index) in list"
                  :key="index"
                  :comment="comment"
                ></comment-item>
                <div
                  v-show="!loading && (list.length < count)"
                  class='mt-8 flex justify-end'
                >
                  <button
                    type="button"
                    class="inline-flex items-center justify-center px-2.5 py-1.5 border border-transparent text-xs font-medium rounded-md shadow-sm text-white bg-gray-900 hover:bg-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900"
                    @click="loadList"
                  >
                    Load more replies
                  </button>
                </div>
                <div
                  v-show="loading"
                  class="mt-8 flex justify-end text-xs font-medium text-gray-900"
                >
                  Loading more replies...
                </div>
              </ul>
            </div>
          </template>
        </div>
      </div>
    </div>
  </li>
</template>
<script>
export default {
  props: {
    comment: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      showList: false,
      list: [],
      count: 0,
      loading: false,
    };
  },
  methods: {
    viewReplies() {
      this.showList = !this.showList;

      if (this.list.length > 0) {
        return;
      }

      this.loadList();
    },
    loadList() {
      if (this.loading) {
        return false;
      }

      this.loading = true;

      axios
        .get("api/comments/" + this.comment.id, {
          params: {
            offset: this.list.length,
          },
        })
        .then((response) => {
          this.list.push(...response.data.data);
          this.count = response.data.count;
        })
        .catch((error) => {
          console.log(error.response.data);
        })
        .then(() => {
          this.loading = false;
        });
    },
    replied(data) {
      this.list.unshift(data);
    },
  },
};
</script>
