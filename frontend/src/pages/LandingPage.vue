<template>
  <DefaultLayout>
    <HeroSection />
    <FeaturedProducts />
    <HowItWorks />
    <LatestArticles />
    <Testimonials />
  </DefaultLayout>
</template>

<script setup>
import DefaultLayout from '@/layouts/DefaultLayout.vue'
import HeroSection from '@/components/landing/HeroSection.vue'
import FeaturedProducts from '@/components/landing/FeaturedProducts.vue'
import HowItWorks from '@/components/landing/HowItWorks.vue'
import LatestArticles from '@/components/landing/LatestArticles.vue'
import Testimonials from '@/components/landing/Testimonials.vue'
</script>
