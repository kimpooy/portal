<template>
  <div class="min-h-screen bg-gray-100 flex flex-col">
    <!-- Header -->
    <header class="bg-white shadow px-6 py-4 flex justify-between items-center">
      <h1 class="text-2xl font-bold text-gray-800">Applicant Dashboard</h1>
      <div class="text-right">
        <p class="font-medium text-gray-800">{{ user.name }}</p>
        <p class="text-sm text-gray-500">{{ user.email }}</p>
      </div>
    </header>

    <!-- Content -->
    <main class="flex-1 p-6 max-w-6xl mx-auto space-y-6">
      <!-- Profile Info -->
      <section class="bg-white rounded-xl shadow p-6">
        <h2 class="text-lg font-semibold text-gray-700 mb-4">Profile Information</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-gray-600">
          <div>
            <p><strong>Full Name:</strong> {{ applicant.first_name }} {{ applicant.middle_name }} {{ applicant.last_name }}</p>
            <p><strong>Email:</strong> {{ applicant.email }}</p>
            <p><strong>Phone:</strong> {{ applicant.phone_number }}</p>
          </div>
          <div>
            <p><strong>Gender:</strong> {{ applicant.gender }}</p>
            <p><strong>Birth Date:</strong> {{ applicant.birth_date }}</p>
            <p><strong>Education:</strong> {{ applicant.highest_education }}</p>
          </div>
        </div>
      </section>

      <!-- Address -->
      <section v-if="applicant.addresses?.length" class="bg-white rounded-xl shadow p-6">
        <h2 class="text-lg font-semibold text-gray-700 mb-4">Address</h2>
        <div v-for="(address, i) in applicant.addresses" :key="i" class="text-gray-600 leading-relaxed">
          <p>{{ address.house_no }} {{ address.street }}, {{ address.barangay }}</p>
          <p>{{ address.city }}, {{ address.province }} {{ address.zip_code }}</p>
          <p>{{ address.country }}</p>
        </div>
      </section>

      <!-- Education -->
      <section v-if="applicant.educational_backgrounds?.length" class="bg-white rounded-xl shadow p-6">
        <h2 class="text-lg font-semibold text-gray-700 mb-4">Educational Background</h2>
        <div class="overflow-x-auto">
          <table class="w-full text-sm border">
            <thead class="bg-gray-100 text-gray-700">
              <tr>
                <th class="p-2 border">Level</th>
                <th class="p-2 border">School</th>
                <th class="p-2 border">Degree/Course</th>
                <th class="p-2 border">Year Graduated</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(edu, i) in applicant.educational_backgrounds" :key="i" class="border-t hover:bg-gray-50">
                <td class="p-2 border">{{ edu.level }}</td>
                <td class="p-2 border">{{ edu.school_name }}</td>
                <td class="p-2 border">{{ edu.degree_course }}</td>
                <td class="p-2 border text-center">{{ edu.year_graduated }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </section>

      <!-- Work Experience -->
      <section v-if="applicant.work_experiences?.length" class="bg-white rounded-xl shadow p-6">
        <h2 class="text-lg font-semibold text-gray-700 mb-4">Work Experience</h2>
        <div class="overflow-x-auto">
          <table class="w-full text-sm border">
            <thead class="bg-gray-100 text-gray-700">
              <tr>
                <th class="p-2 border">Position</th>
                <th class="p-2 border">Company</th>
                <th class="p-2 border">From</th>
                <th class="p-2 border">To</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(work, i) in applicant.work_experiences" :key="i" class="border-t hover:bg-gray-50">
                <td class="p-2 border">{{ work.position_title }}</td>
                <td class="p-2 border">{{ work.company_name }}</td>
                <td class="p-2 border text-center">{{ work.from }}</td>
                <td class="p-2 border text-center">{{ work.to }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </section>

      <!-- Eligibility -->
      <section v-if="applicant.eligibilities?.length" class="bg-white rounded-xl shadow p-6">
        <h2 class="text-lg font-semibold text-gray-700 mb-4">Eligibility</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
          <div
            v-for="(elig, i) in applicant.eligibilities"
            :key="i"
            class="border rounded-lg p-4 bg-gray-50 hover:shadow-md transition"
          >
            <p><strong>License #:</strong> {{ elig.license_number }}</p>
            <p class="text-sm text-gray-500">Valid Until: {{ elig.license_validity }}</p>
          </div>
        </div>
      </section>
    </main>
  </div>
</template>

<script setup>
const props = defineProps({
  user: Object,
  applicant: Object
});
</script>
