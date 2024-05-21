<template>
  <div class="bg-white p-0 lg:p-4 rounded-sm flex flex-col">
    <div class="max-w-full overflow-x-auto">
      <table class="w-full table-auto text-left text-sm lg:text-base">
        <thead class="uppercase text-xs tracking-widest">
          <tr>
            <slot name="header"></slot>
          </tr>
        </thead>
        <tbody>
          <slot name="body"></slot>
        </tbody>
      </table>
    </div>
    <slot name="footer"></slot>
  </div>
</template>
