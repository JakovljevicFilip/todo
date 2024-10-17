import { NewTask } from './NewTask';
import { TaskStatus } from './Status';

export interface Task extends NewTask {
    id: string;
    status: TaskStatus;
    created_at: string;
    updated_at: string;
}
