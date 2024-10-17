<template>
    <q-btn
        @click="confirm"
        icon="delete"
        round
        color="negative"
        size="lg"
    >
        <q-tooltip>
            Remove
        </q-tooltip>
    </q-btn>
</template>
<script lang="ts" setup>
import { inject } from 'vue';
import { useQuasar } from 'quasar';
import { deleteTask } from '../../../../services/TaskService';
import { useTaskStore } from '../../../../stores/TaskStore';

const taskStore = useTaskStore();
const task = inject('task');
const $q = useQuasar();

const confirm = () => {
    $q.dialog({
        title: `Delete task: "${task.value.title}"?`,
        message: 'Are you sure that you would like to delete this task? Once deleted the task can no longer be recovered.',
        cancel: true,
    }).onOk(async () => {
        await deleteTask(task.value);
        taskStore.removeTask(task.value);
    });
}
</script>
<style scoped>

</style>
