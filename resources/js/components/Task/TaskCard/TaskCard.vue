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
            <p :class="{'text-italic text-caption': !task.description}">
                {{ task.description || 'No description available for this task.'}}
            </p>
        </q-card-section>

        <q-card-actions
            v-if="displayActionButtons"
            :key="rerenderCardActionsKey"
            class="absolute-top-right column justify-center"
        >
            <IncompleteTaskActions v-if="task.status !== TaskStatus.Completed"/>
            <CompleteTaskActions v-if="task.status === TaskStatus.Completed"/>
        </q-card-actions>
    </q-card>
</template>

<script setup lang="ts">
import { computed, PropType, provide, ref, watch } from 'vue';
import { Task } from '../../../types/Task';
import IncompleteTaskActions from './IncompleteTaskActions/IncompleteTaskActions.vue';
import { TaskStatus } from '../../../types/Status';
import CompleteTaskActions from './CompleteTaskActions/CompleteTaskActions.vue';

const props = defineProps({
    task: {
        type: Object as PropType<Task>,
        required: true,
    },
});
const reactiveTask = ref(props.task)
provide('task', reactiveTask);

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

const rerenderCardActionsKey = ref(0);
watch(() => props.task, (newTask) => {
    reactiveTask.value = newTask
    rerenderCardActionsKey.value++;
}, { deep: true });

</script>

<style scoped>

</style>
