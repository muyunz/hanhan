export const formatCurrency = (number) => number.toLocaleString('zh-TW', { style: 'currency', currency: 'TWD', minimumIntegerDigits: 1, minimumFractionDigits: 0 })

export const toFormData = (obj, exceptNull = true) => {
  const formData = new FormData();
  Object.keys(obj).forEach(key => {
    if(obj[key] === null && exceptNull) { return; }
    formData.append(key, obj[key]);
  });
  return formData;
}

export const uuid = () => {
  var d = Date.now();
  if (typeof performance !== 'undefined' && typeof performance.now === 'function'){
    d += performance.now(); //use high-precision timer if available
  }
  return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function (c) {
    var r = (d + Math.random() * 16) % 16 | 0;
    d = Math.floor(d / 16);
      return (c === 'x' ? r : (r & 0x3 | 0x8)).toString(16);
  });
}

export const valuesById = (obj) => {
  return Object.keys(obj.byId).map(id => obj.byId[id]);
}