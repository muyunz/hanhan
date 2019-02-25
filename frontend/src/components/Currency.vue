<template>
  <span class="currency">
    {{ formattedNumber }}
  </span>
</template>

<script>
import { formatCurrency } from '@/libs/utils'

export default {
  props: {
    number: {
      type: Number
    }
  },
  computed: {
    formattedNumber() {
      return formatCurrency(this.number)
    }
  }
}
</script>
