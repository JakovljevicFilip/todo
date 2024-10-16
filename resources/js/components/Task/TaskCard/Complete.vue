<template>
    <q-btn
        label="Complete"
        color="positive"
        @click="complete"
    />
</template>
<script lang="ts" setup>
import { PropType, defineProps } from 'vue';
import { Task } from '../../../types/Task.js';
import { completeTask } from '../../../services/TaskService';
import { useTaskStore } from '../../../stores/TaskStore';

const props = defineProps({
    task: {
        type: Object as PropType<Task>,
        required: true,
    },
});

const taskStore = useTaskStore();

const complete = async () => {
    await completeTask(props.task);
    taskStore.removeTask(props.task);
}
</script>
<style scoped>

</style>
