<script setup></script>

<template>
  <div class="flex items-center gap-2">
    <span class="hidden text-right lg:block">
      <span class="block text-sm font-medium">
        {{ $page.props.auth.name }}
      </span>
    </span>

    <span class="h-12 w-12 rounded-full overflow-hidden border flex items-center justify-center">
      <img src="/profile.jpg" alt="User" />
    </span>
  </div>
</template>
