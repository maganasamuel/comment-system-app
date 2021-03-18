<template>
  <section
    aria-labelledby="comments-title"
    class="mt-8 xl:mt-10"
  >
    <div>
      <div class="divide-y divide-gray-200">
        <div class="pb-4">
          <h2
            id="comments-title"
            class="text-lg font-medium text-gray-900"
          >
            Comments</h2>
        </div>
        <div class="pt-6">
          <post-comment @posted="posted"></post-comment>

          <!-- Comments feed-->
          <div class="flow-root mt-6">
            <ul>
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
                  Load more comments
                </button>
              </div>
              <div
                v-show="loading"
                class="mt-8 flex justify-end text-xs font-medium text-gray-900"
              >
                Loading more comments...
              </div>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  data() {
    return {
      list: [],
      count: 0,
      loading: false,
    };
  },
  mounted() {
    this.loadList();
  },
  methods: {
    loadList() {
      if (this.loading) {
        return false;
      }

      this.loading = true;

      axios
        .get("api/comments", {
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
    posted(data) {
      this.list.unshift(data);
    },
  },
};
</script>
