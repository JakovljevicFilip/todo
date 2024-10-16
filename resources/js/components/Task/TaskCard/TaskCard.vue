<template>
    <q-card
        class="relative-position"
        @mouseenter="displayActionButtons=true"
        @mouseleave="displayActionButtons=false"
    >
        <q-card-section>
            <div class="text-h6">{{ task.title }}</div>
            <div class="text-subtitle2"><q-icon name="schedule"/>: {{ formattedScheduledDate }}</div>
        </q-card-section>

        <q-separator inset />

        <q-card-section>
            {{ task.description }}
        </q-card-section>

        <q-card-actions v-if="displayActionButtons" class="row">
            <Complete class="col" :task="task"/>
            <Change class="col" :task="task" />
            <Delete class="col" :task="task" />
        </q-card-actions>
    </q-card>
</template>

<script setup lang="ts">
import { computed, PropType, ref } from 'vue';
import { Task } from '../../../types/Task';
import Delete from './Delete.vue';
import Change from './Change.vue';
import Complete from './Complete.vue';

const props = defineProps({
    task: {
        type: Object as PropType<Task>,
        required: true,
    },
});

const displayActionButtons = ref(false);

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

<style scoped>

</style>
