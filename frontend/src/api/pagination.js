import config from '@/config';

export const generatePaginationParams = (page = 1, perPage = 10) => {
  let params = [];
  params[config.pagination.pageName] = page;
  params[config.pagination.perPageName] = perPage;
  return params;
}

export const extractPaginationMeta = (paginated) => {
  return generatePagination(paginated.current_page, paginated.per_page, paginated.total)
}

export const generatePagination = (page = 1, perPage = 15, total = 0) => {
  return {
    page,
    perPage,
    total
  }
}

export default {
  generatePaginationParams,
  extractPaginationMeta,
  generatePagination
}