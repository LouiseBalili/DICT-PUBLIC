<template>
  <div class="tooltip-container" @mouseover="showTooltip" @mouseleave="isShown = false">
    <slot></slot>
    <Transition
    enter-from-class="opacity-0"
    enter-active-class="transition-opacity delay-150"
    enter-to-class="opacity-100"
    leave-from-class="opacity-100"
    leave-active-class="transition-opacity"
    leave-to-class="opacity-0"
    >
      <div v-if="isShown" class="tooltip">
        {{ text }}
      </div>
    </Transition>
  </div>
</template>
  
<script setup>
import { ref } from 'vue';

const props = defineProps({
  text: {
    type: String,
    required: true,
  },
  duration: {
    type: Number,
    default: 200
  }
})

const isShown = ref(false)

const showTooltip = () => {
    isShown.value = true;
}
</script>
  
<style scoped>
.tooltip-container {
  position: relative;
  display: inline-block;
}

.tooltip {
  position: absolute;
  bottom: 100%;
  left: 50%;
  transform: translateX(-50%);
  background-color: #333;
  color: #fff;
  padding: 5px 10px;
  border-radius: 5px;
  visibility: visible;
  opacity: 0;
  transition: opacity 0.3s ease;
}

.tooltip::after {
  content: "";
  position: absolute;
  top: 100%;
  left: 50%;
  margin-left: -5px;
  border-width: 5px;
  border-style: solid;
  border-color: #333 transparent transparent transparent;
}

.tooltip-container:hover .tooltip {
  visibility: visible;
  opacity: 1;
}
</style>
  