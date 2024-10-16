<template>
    <q-btn
        @click="viewTask"
        color="primary"
        icon="edit"
        round
        size="lg"
    >
        <q-tooltip>
            Change Task
        </q-tooltip>
    </q-btn>
</template>

<script lang="ts" setup>
import { defineProps, PropType } from 'vue';
import { Task } from '../../../types/Task';
import { fetchTask } from '../../../services/TaskService';
import { useTaskStore } from '@/stores/TaskStore';

const props = defineProps({
    task: {
        type: Object as PropType<Task>,
        required: true,
    },
});

const taskStore = useTaskStore();

const viewTask = async () => {
    const task = await fetchTask(props.task.id);
    taskStore.setTask(task);
    taskStore.openTaskDialog();
}
</script>

<style scoped>
</style>
