<template>
  <vue-good-table
    mode="remote"
    @on-page-change="onPageChange"
    @on-per-page-change="onPerPageChange"
    :totalRows="totalRecords"
    :isLoading.sync="isLoading"
    @on-search="onSearch"
    @on-sort-change="onSortChange"
    :pagination-options="{
    enabled: true,
    }"
    :search-options="{
    enabled: true,
    trigger: 'enter',
    }"
    :rows="rows"
    :columns="columns"
  />
</template>
<script>
export default {
  data() {
    return {
      searchKey: undefined,
      isLoading: false,
      columns: [
        //...
      ],
      rows: [],
      totalRecords: 0,
      serverParams: {
        columnFilters: {},
        sort: [
          {
            field: "Body",
            type: "asc"
          },
          {
            field: "Title",
            type: "asc"
          }
        ],
        page: 1,
        perPage: 20
      }
    };
  },
  async mounted() {
    this.getDataFromServer(this.serverParams.page, this.serverParams.perPage);
  },
  methods: {
    onPageChange(params) {
      this.getDataFromServer(params.currentPage, this.serverParams.perPage);
    },
    onPerPageChange(params) {
      this.getDataFromServer(this.serverParams.page, params.currentPerPage);
    },
    onSearch(params) {
      this.searchKey = params.searchTerm;
    },
    onSortChange(params) {
      this.getDataFromServer(
        this.serverParams.page,
        this.serverParams.perPage,
        `sort=${params[0].field},${params[0].type}`
      );
    },
    async getDataFromServer(page, perPage, sort = null) {
      let posts = await axios.get(
        `get-posts?page=${page}&per_page=${perPage}&${sort}&q=${this.searchKey}`
      );
      this.columns = posts.data.columns;
      this.rows = posts.data.posts.data;
      this.totalRecords = posts.data.posts.total;
      this.serverParams.page = posts.data.posts.current_page;
      this.serverParams.perPage = posts.data.posts.per_page;
    }
  }
};
</script>