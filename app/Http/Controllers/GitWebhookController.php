<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GitWebhookController extends Controller
{
    public function handle(Request $request)
    {
        // Optional: Kiểm tra GitHub Signature nếu dùng secret
        $secret = env('GITHUB_WEBHOOK_SECRET')||'123456789';
        $signature = $request->header('X-Hub-Signature-256');
        $payload = $request->getContent();

        if ($secret && $signature) {
            $hash = 'sha256=' . hash_hmac('sha256', $payload, $secret);
            if (!hash_equals($hash, $signature)) {
                Log::warning('Invalid GitHub webhook signature');
                return response()->json(['message' => 'Invalid signature'], 403);
            }
        }

        // Lấy dữ liệu JSON từ payload
        $data = $request->json()->all();

        // Kiểm tra có phải push vào nhánh master không
        if (($data['ref'] ?? '') === 'refs/heads/master') {
            // Đường dẫn project Laravel
            $projectPath = base_path();

            // Chạy lệnh git pull
            $output = [];
            $returnVar = 0;
            exec("cd {$projectPath} && git pull origin master 2>&1", $output, $returnVar);

            // Ghi log
            Log::info('Git pull executed from webhook', [
                'output' => $output,
                'return_code' => $returnVar,
            ]);

            return response()->json([
                'message' => 'Git pull executed.',
                'output' => $output,
            ]);
        }

        return response()->json(['message' => 'Not master branch, skipped.']);
    }
}
