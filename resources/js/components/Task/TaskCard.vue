<script setup lang="ts">
import { computed, PropType } from 'vue';
import { Task } from '../../types/task.js';

const props = defineProps({
    task: {
        type: Object as PropType<Task>,
        required: true,
    },
});

const formattedScheduledDate = computed(() => {
    if (!props.task.scheduled) return 'Not set.';
    const date = new Date(props.task.scheduled);
    return new Intl.DateTimeFormat('en-US', {
        month: 'long',
        day: 'numeric',
        year: 'numeric',
    }).format(date);
});

</script>

<template>
      <q-card>
        <q-card-section>
            <div class="text-h6">{{ task.title }}</div>
            <div class="text-subtitle2"><q-icon name="schedule"/>: {{ formattedScheduledDate }}</div>
        </q-card-section>

        <q-separator inset />

        <q-card-section>
          {{ task.description }}
        </q-card-section>
      </q-card>
</template>

<style scoped>

</style>
