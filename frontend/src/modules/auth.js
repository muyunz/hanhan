import config from '@/config'
import api, { setAuthorization } from '@/api';
import * as auth from '@/api/auth'
import { getPayload } from '@/libs/jwt'

export const SET_LOGIN_REDIRECT = 'SET_LOGIN_REDIRECT'

export const LOGIN_BY_CRENDENTIALS_REQUEST = 'LOGIN_BY_CRENDENTIALS_REQUEST'
export const LOGIN_BY_CRENDENTIALS_SUCCESS = 'LOGIN_BY_CRENDENTIALS_SUCCESS'
export const LOGIN_BY_CRENDENTIALS_FAILURE = 'LOGIN_BY_CRENDENTIALS_FAILURE'

export const LOGIN_BY_TOKEN_REQUEST = 'LOGIN_BY_TOKEN_REQUEST'
export const LOGIN_BY_TOKEN_SUCCESS = 'LOGIN_BY_TOKEN_SUCCESS'
export const LOGIN_BY_TOKEN_FAILURE = 'LOGIN_BY_TOKEN_FAILURE'

export const LOGOUT = 'LOGOUT'

export default {
  namespaced: true,
  state: {
    loginRedirect: '/',
    authenticated: false,
    user: null
  },

  mutations: {
    [SET_LOGIN_REDIRECT] (state, url) {
      state.loginRedirect = url
    },

    [LOGIN_BY_CRENDENTIALS_REQUEST] () {},
    [LOGIN_BY_CRENDENTIALS_SUCCESS] (state, token) {
      let payload = getPayload(token);

      state.authenticated = true;
      state.user = payload.user;

      localStorage.setItem('jwt_token', token);
      setAuthorization(token);
    },

    [LOGIN_BY_CRENDENTIALS_FAILURE] (state, error) {
    },

    [LOGIN_BY_TOKEN_REQUEST] (state) {},
    [LOGIN_BY_TOKEN_SUCCESS] (state, token) {
      let payload = getPayload(token)

      state.authenticated = true
      state.user = payload.user

      localStorage.setItem('jwt_token', token);
      setAuthorization(token);
    },

    [LOGIN_BY_TOKEN_FAILURE] (state, error) {},

    [LOGOUT] (state) {
      localStorage.removeItem('jwt_token')
      state.authenticated = false
      state.loginRedirect = '/'
      state.user = null
    }
  },

  actions: {
    loginByCredential ({
      commit
    }, crendential) {
      return new Promise((resolve, reject) => {
        commit(LOGIN_BY_CRENDENTIALS_REQUEST)
        auth.login(crendential)
          .then(res => {
            commit(LOGIN_BY_CRENDENTIALS_SUCCESS, res.data.data.access_token)
            resolve()
          })
          .catch(error => {
            commit(LOGIN_BY_CRENDENTIALS_FAILURE, error)
            reject(error)
          })
      })
    },

    loginByToken ({
      commit
    }, token) {
      return new Promise((resolve, reject) => {
        commit(LOGIN_BY_TOKEN_REQUEST)
        auth.check()
          .then(response => {
            commit(LOGIN_BY_TOKEN_SUCCESS, token)
            resolve()
          })
          .catch(error => {
            commit(LOGIN_BY_TOKEN_FAILURE, error)
            reject(error)
          })
      })
    },

    logout ({
      commit
    }) {
      commit(LOGOUT)
    },

    setLoginRedirect ({
      commit
    }, url) {
      commit(SET_LOGIN_REDIRECT, url)
    }
  },

  getters: {
    authenticated: state => state.authenticated
  }
}