<?php

// Menggunakan  2 atau lebih Namespace
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    // Penggunaan Do While dan If Then dan untuk Membaca Data
    public function index()
    {
        // Penggunaan Array
        $tasks = Task::all();
        $taskStatuses = [];
        $index = 0;
        $totalTasks = count($tasks);

        do {
            if ($index >= $totalTasks) break;
            $task = $tasks[$index];
            if (!isset($taskStatuses[$task->status])) {
                $taskStatuses[$task->status] = 0;
            }
            $taskStatuses[$task->status]++;
            $index++;
        } while ($index < $totalTasks);

        $overdueTasks = $this->getOverdueTasks($tasks);

        return view('tasks.index', compact('tasks', 'taskStatuses', 'overdueTasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    // Untuk Create Data
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,in_progress,completed',
        ]);

        Task::create($request->all());

        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index');
    }

    // Metode untuk mendapatkan tugas yang terlambat pakai prosedur dan function
    protected function getOverdueTasks($tasks)
    {
        // Penggunaan Array
        $overdueTasks = [];
        foreach ($tasks as $task) {
            if ($this->isOverdue($task)) {
                $overdueTasks[] = $task;
            }
        }
        return $overdueTasks;
    }

    // Metode untuk memeriksa apakah tugas terlambat
    protected function isOverdue($task)
    {
        return $task->status === 'pending' && $task->created_at->lt(now()->subDays(7));
    }
}

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\Models\Task;

// class TaskController extends Controller
// {

//     // Penggunaan Do While dan If Then dan untuk Membaca Data
//     public function index()
//     {
//         // Pengunaan Array
//     $tasks = Task::all();
//     $taskStatuses = [];
//     $index = 0;
//     $totalTasks = count($tasks);

//     do {
//         if ($index >= $totalTasks) break;
//         $task = $tasks[$index];
//         if (!isset($taskStatuses[$task->status])) {
//             $taskStatuses[$task->status] = 0;
//         }
//         $taskStatuses[$task->status]++;
//         $index++;
//     } while ($index < $totalTasks);

//     return view('tasks.index', compact('tasks', 'taskStatuses'));
//     }

    
//     public function create()
//     {
//         return view('tasks.create');
//     }

//     // Untuk Create Data
//     public function store(Request $request)
//     {
//         $request->validate([
//             'title' => 'required|string|max:255',
//             'description' => 'nullable|string',
//             'status' => 'required|in:pending,in_progress,completed',
//         ]);
    
//         Task::create($request->all());
//         return redirect()->route('tasks.index');
//     }
    

//     public function destroy(Task $task)
//     {
//         $task->delete();
//         return redirect()->route('tasks.index');
//     }


//      // Metode untuk mendapatkan tugas yang terlambat pakai prosedur dan function
//      protected function getOverdueTasks($tasks)
//      {
//         // Pengunaan Array
//          $overdueTasks = [];
//          foreach ($tasks as $task) {
//              if ($this->isOverdue($task)) {
//                  $overdueTasks[] = $task;
//              }
//          }
//          return $overdueTasks;
//      }
 
//      // Metode untuk memeriksa apakah tugas terlambat
//      protected function isOverdue($task)
//      {
//          return $task->status === 'pending' && $task->created_at->lt(now()->subDays(7));
//      }
// }
