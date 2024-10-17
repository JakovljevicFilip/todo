<template>
    <q-btn
        @click="viewTask"
        color="primary"
        icon="edit"
        round
        size="lg"
    >
        <q-tooltip>
            Change
        </q-tooltip>
    </q-btn>
</template>

<script lang="ts" setup>
import { inject } from 'vue';
import { fetchTask } from '../../../../services/TaskService';
import { useTaskStore } from '@/stores/TaskStore';

const originalTask = inject('task');

const taskStore = useTaskStore();

const viewTask = async () => {
    const task = await fetchTask(originalTask.value.id);
    taskStore.setTask(task);
    taskStore.openTaskDialog();
}
</script>

<style scoped>
</style>
