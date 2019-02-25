import axios from '@/api';

export const login = (credentials) => {
  return axios.post('/auth/login', {
    ...credentials
  })
}
