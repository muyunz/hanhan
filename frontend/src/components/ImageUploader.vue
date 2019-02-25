<template>
  <div class="image-uploader">
    <slot v-if="previewSrc || defaultPreviewSrc" name="preview">
      <div class="image-uploader__preview" :style="{width: previewWidth, height: previewHeight}">
        <img :src="previewSrc || defaultPreviewSrc" alt="">
      </div>
    </slot>
    <div @click="openFileDialog" class="image-uploader__placeholder" :class="{'image-uploader__placeholder--cover': file || defaultPreviewSrc}">
      <Icon type="ios-cloud-upload-outline" size="50"/>
    </div>
    <input @change="onFileChange" type="file" name="file" ref="file" style="display:none;">
  </div>
</template>

<script>
export default {
  props: {
    previewWidth: {
      type: [String, Number]
    },
    previewHeight: {
      type: [String, Number]
    },
    defaultPreviewSrc: {
      type: String,
      default: null
    }
  },
  data() {
    return {
      file: null,
      previewSrc: null
    }
  },
  methods: {
    openFileDialog() {
      this.$refs.file.click();
    },
    onFileChange(e) {
      if (e.target.files && e.target.files[0]) {
        this.file = e.target.files[0];
        this.loadFile(this.file);
        this.emitFile(this.file)
      }
    },
    loadFile(file) {
      const reader = new FileReader();
      reader.onload = (e) => {
        this.previewSrc = e.target.result;
      }
      reader.readAsDataURL(file);
    },
    emitFile(file) {
      this.$emit('change', file);
    }
  }
}
</script>

<style lang="scss">
.image-uploader {
  position: relative;
  width: 150px;
  height: 150px;
  overflow: hidden;
  .image-uploader__preview {
    img {
      width: 100%;
      height: 100%;
    }
  }
  .image-uploader__placeholder {
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 1px solid #eee;
    width: 100%;
    height: 100%;
    background: #f2f2f2;

    &.image-uploader__placeholder--cover {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: rgba(0, 0, 0, 0.3);
      opacity: 0;
      .ivu-icon {
        color: #fff;
      }
      &:hover {
        opacity: 1;
      }
    }
  }
}
</style>
