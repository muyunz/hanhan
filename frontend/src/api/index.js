import axios from 'axios';
import config from '@/config';

// 建立實體
const instance = axios.create({
  baseURL: config.api.baseUrl,
  headers: {'Access-Control-Allow-Origin': '*'}
});

// 設置 Authorization
export const setAuthorization = (token) => {
  instance.defaults.headers.common['Authorization'] = `Bearer ${token}` 
}

export default instance;

// 針對 Laravel Patch/Put 如果使用 FormData 會取得空陣列的問題
export const patch = (url, data = null, options = {}) => {
  return postByMethod('patch', url, data, options);
}

export const put = (url, data = null, options = {}) => {
  return postByMethod('put', url, data, options);
}

export const postByMethod = (method = 'post', url, data = null, options = {}) => {
  if (data instanceof FormData) {
    data.append('_method', method)
    return instance.post(url, data, options);
  }

  return instance[method](url, data, options);
}

// 分頁工具
export { default as pagination } from './pagination'
