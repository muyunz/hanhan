import axios, { pagination, patch } from '@/api'
import config from '@/config';

export const fetchAllProducts = () => {
  return axios.get(`/products/all`);
}

export const fetchProducts = (offset = 0, limit = 50, filters = []) => {
  return axios.get(`/products`, {
    params: {
      ...pagination.generatePaginationParams(offset, limit)
    }
  })
}

export const fetchProductPaginated = (page = 1, perPage = config.product.list.perPage) => {
  return axios.get('/products', {
    params: {
      ...pagination.generatePaginationParams(page, perPage)
    }
  });
}

export const createProduct = (product) => {
  return axios.post('/products', product);
}

export const deleteProduct = (id) => {
  return axios.delete(`/products/${id}`);
}

export const fetchProduct = (id) => {
  return axios.get(`/products/${id}`);
}

export const patchProduct = (id, productPatch) => {
  return patch(`/products/${id}`, productPatch);
}

export const addProductOption = (productId, option) => {
  return axios.post(`/products/${productId}/options`, option);
}

export const deleteProductOption = (productId, optionId) => {
  return axios.delete(`/products/${productId}/options`, {
    params: {
      option_id: optionId
    }
  })
}

export const fetchProductOptions = (productId) => {
  return axios.get(`/products/${productId}/options`);
}

export const patchProductOption = (productId, optionId, option) => {
  return patch(`/products/${productId}/options`, option, {
    params: {
      option_id: optionId
    }
  });
}