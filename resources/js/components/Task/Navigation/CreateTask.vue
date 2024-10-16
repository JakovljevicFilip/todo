<template>
    <q-btn size="lg" label="Create new task" @click="openTaskDialog" />
    <TaskDialog />
</template>

<script setup>
import TaskDialog from '../TaskDialog.vue';
import { useTaskStore } from '@/stores/TaskStore';

const taskStore = useTaskStore();
const openTaskDialog = () => {
    taskStore.openTaskDialog();
};
</script>

<style scoped>
</style>
