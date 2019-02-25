import _ from 'lodash';

const ValidatePlugin = {
    install(Vue) {
        // 驗證角色
        Vue.prototype.$dirtyAndInvalid = function (field) {
            if (!field.$dirty) return false
            return field.$invalid
        }

        Vue.prototype.$messages = function (field, messages) {
            return Object.keys(field.$params)
                .filter(param => {
                    return !field[param]
                })
                .map(param => {
                    return messages[param]
                })
        }

        Vue.prototype.$error = function (field, messages) {
            if (field && this.$dirtyAndInvalid(field)) {
                return this.$messages(field, messages).pop();
            }
            return '';
        }

        Vue.prototype.$validate = function (field, callback = null, invalidCallback = null) {
            field.$touch()
            if (!field.$invalid) {
                callback && callback()
            } else {
                invalidCallback && invalidCallback()
            }
        }

        Vue.prototype.$extractDirtyFields = function (field) {
            let obj = {};
            walkFields(field, obj)
            return obj;
        }

        function walkFields (field, obj) {
            return Object.keys(field.$params).forEach(key => {
                const _field = field.$params[key];
                const _validation = field[key];
                const _model = field.$model[key];

                // 該值被修改過
                if (_validation.$dirty) {
                    obj[key] = _model;
                }

                if (_field && _validation.$dirty) {
                    return walkFields(_field, obj);
                }
            });
        }
    }
}

export default ValidatePlugin