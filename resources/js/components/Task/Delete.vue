<template>
    <q-btn
        label="Delete"
        color="negative"
        @click="confirm"
    />
</template>
<script lang="ts" setup>
import { PropType, defineProps } from 'vue';
import { Task } from '../../types/Task.js';
import { useQuasar } from 'quasar';
import { deleteTask } from '../../services/TaskService';
import { useTaskStore } from '../../stores/TaskStore';

const props = defineProps({
    task: {
        type: Object as PropType<Task>,
        required: true,
    },
});

const taskStore = useTaskStore();
const $q = useQuasar();

const confirm = () => {
    $q.dialog({
        title: `Delete task: "${props.task.title}"?`,
        message: 'Are you sure that you would like to delete this task? Once deleted the task can no longer be recovered.',
        cancel: true,
    }).onOk(async () => {
        await deleteTask(props.task);
        taskStore.deleteTask(props.task);
    });
}
</script>
<style scoped>

</style>
