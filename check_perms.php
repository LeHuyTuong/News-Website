<?php
$u = \App\Models\User::where('email', 'admin@tuongdev.com')->first();
if (!$u) {
    echo "User not found!\n";
    exit;
}
echo "User: " . $u->name . "\n";
echo "ID: " . $u->id . "\n";
echo "Roles: " . implode(', ', $u->getRoleNames()->toArray()) . "\n";
echo "Can Delete Posts? " . ($u->can('delete posts') ? "YES" : "NO") . "\n";

$p = \Spatie\Permission\Models\Permission::where('name', 'delete posts')->first();
echo "Permission 'delete posts' exists? " . ($p ? "YES" : "NO") . "\n";
