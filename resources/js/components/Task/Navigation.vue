<template>
    <q-btn color="green-7" text-color="white" size="lg" label="Add new" @click="openTaskDialog" />
    <TaskDialog />

</template>

<script setup>
import TaskDialog from './TaskDialog.vue';
import { useTaskStore } from '@/stores/TaskStore';

const taskStore = useTaskStore();
const openTaskDialog = () => {
    taskStore.openTaskDialog();
};
</script>

<style scoped>
</style>
