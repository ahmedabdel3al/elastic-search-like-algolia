export const indexMixin = (url) => ({
  data() {
    return {
      searchKey: null,
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
      console.log(params)
      this.searchKey = params.searchTerm;
      this.getDataFromServer(
        this.serverParams.page,
        this.serverParams.perPage,
        this.searchKey
      );
    },
    onSortChange(params) {
      this.getDataFromServer(
        this.serverParams.page,
        this.serverParams.perPage,
        this.searchKey,
        `sort=${params[0].field},${params[0].type}`
      );
    },
    async getDataFromServer(page, perPage, key = null, sort = null) {
      let posts = await axios.get(
        `${url}?page=${page}&per_page=${perPage}&${sort}&q=${key}`
      );
      this.columns = posts.data.columns;
      this.rows = posts.data.posts.data;
      this.totalRecords = posts.data.posts.total;
      this.serverParams.page = posts.data.posts.current_page;
      this.serverParams.perPage = posts.data.posts.per_page;
    }
  }
});
export default indexMixin;