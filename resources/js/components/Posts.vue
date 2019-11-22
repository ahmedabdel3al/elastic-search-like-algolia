<template>
  <vue-good-table
    mode="remote"
    @on-page-change="onPageChange"
    @on-per-page-change="onPerPageChange"
    :totalRows="totalRecords"
    :isLoading.sync="isLoading"
    @on-search="onSearch"
    @on-sort-change="onSortChange"
    :select-options="{ enabled: true }"
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
import indexMixin from "./indexMixin";
export default {
  mixins: [indexMixin("get-posts")]
};
</script>