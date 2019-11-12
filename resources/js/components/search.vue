<template>
  <div>
    <vue-tags-input
      v-model="tag"
      :tags="tags"
      :autocomplete-items="autocompleteItems"
      :add-only-from-autocomplete="true"
      @tags-changed="update"
      @before-adding-tag="redirectToSinglePreview"
      placehodler="search"
    />
  </div>
</template>

<script>
import VueTagsInput from "@johmun/vue-tags-input";
import axios from "axios";

export default {
  components: {
    VueTagsInput
  },
  data() {
    return {
      tag: "",
      tags: [],
      autocompleteItems: [],
      debounce: null
    };
  },
  watch: {
    tag: "initItems"
  },
  methods: {
    update(newTags) {
      this.autocompleteItems = [];
      this.tags = newTags;
    },
    redirectToSinglePreview(item) {
      if (item.tag.id) {
        return (window.location.href = `/posts/${item.tag.id}`);
      }
    },
    initItems() {
      if (this.tag) {
        const url = `/search?q=${this.tag}`;

        clearTimeout(this.debounce);
        this.debounce = setTimeout(() => {
          axios
            .get(url)
            .then(response => {
              let items = response.data.data;
              this.autocompleteItems = items.map(item => {
                return { text: item.title, id: item.id };
              });
            })
            .catch(() => console.warn("Oh. Something went wrong"));
        }, 600);
      }
    }
  }
};
</script>