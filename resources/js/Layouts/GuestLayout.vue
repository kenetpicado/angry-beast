<script setup>
defineProps(['title', 'subtitle', 'description'])
</script>

<template>
    <div class="grid place-content-center min-h-screen">
        <div class="mx-auto max-w-screen-2xl p-4 md:p-6 xl:p-10">
            <div class="rounded-sm border border-stroke bg-white h-full">
                <div class="flex flex-wrap items-center">
                    <div class="hidden w-full xl:block xl:w-1/2">
                        <div class="py-10 px-26 text-center">
                            <p class="font-medium xl:px-20 text-lg">
                                {{description}}
                            </p>
                            <span class="mt-6 inline-block">
                                <img alt="illustration" class="w-1/3 mx-auto" src="/images/register.png"/>
                            </span>
                        </div>
                    </div>
                    <div class="w-full border-stroke xl:w-1/2 xl:border-l-2">
                        <div class="w-full p-5 sm:p-12 xl:p-17">
                            <span class="mb-1.5 block font-medium">
                                {{ subtitle }}
                            </span>
                            <h2 class="mb-9 text-2xl font-bold text-black sm:text-title-xl2">
                                {{ title }}
                            </h2>
                            <slot></slot>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
