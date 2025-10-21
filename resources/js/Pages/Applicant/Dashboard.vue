<script setup>
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { User, Mail, Phone, MapPin, GraduationCap, Briefcase, Award, FileText, Edit, CheckCircle, Clock, XCircle } from 'lucide-vue-next';

const props = defineProps({
    user: Object,
    profile: Object,
    jobs: Array,
    applications: Array
});

const activeTab = ref('overview');

const getStatusColor = (status) => {
    switch (status.toLowerCase()) {
        case 'pending': return 'bg-yellow-100 text-yellow-800';
        case 'under review': return 'bg-blue-100 text-blue-800';
        case 'approved': return 'bg-green-100 text-green-800';
        case 'rejected': return 'bg-red-100 text-red-800';
        default: return 'bg-gray-100 text-gray-800';
    }
};
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="min-h-screen bg-gray-50">
            <!-- Header -->
            <div class="bg-white shadow">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center text-white text-2xl font-bold">
                                {{ profile.first_name[0] }}{{ profile.last_name[0] }}
                            </div>
                            <div>
                                <h1 class="text-3xl font-bold text-gray-900">
                                    {{ profile.first_name }} {{ profile.last_name }}
                                </h1>
                                <p class="text-gray-600">{{ profile.email }}</p>
                            </div>
                        </div>
                        <Link :href="route('applicant.profile.edit')" class="flex items-center space-x-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                            <Edit class="w-4 h-4" />
                            <span>Edit Profile</span>
                        </Link>
                    </div>
                </div>
            </div>

            <!-- Tabs -->
            <div class="bg-white border-b">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <nav class="flex space-x-8">
                        <button
                            v-for="tab in ['overview', 'education', 'experience', 'eligibility', 'trainings', 'applications']"
                            :key="tab"
                            @click="activeTab = tab"
                            :class="[
                                'py-4 px-1 border-b-2 font-medium text-sm capitalize',
                                activeTab === tab
                                    ? 'border-blue-600 text-blue-600'
                                    : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'
                            ]"
                        >
                            {{ tab }}
                        </button>
                    </nav>
                </div>
            </div>

            <!-- Content -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <!-- Overview Tab -->
                <div v-if="activeTab === 'overview'" class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Personal Information -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <h2 class="text-xl font-semibold mb-4 flex items-center">
                            <User class="w-5 h-5 mr-2 text-blue-600" />
                            Personal Information
                        </h2>
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Full Name:</span>
                                <span class="font-medium">{{ profile.first_name }} {{ profile.last_name }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Birth Date:</span>
                                <span class="font-medium">{{ new Date(profile.birth_date).toLocaleDateString() }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Gender:</span>
                                <span class="font-medium">{{ profile.gender }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Civil Status:</span>
                                <span class="font-medium">{{ profile.civil_status }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Religion:</span>
                                <span class="font-medium">{{ profile.religion }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Information -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <h2 class="text-xl font-semibold mb-4 flex items-center">
                            <Mail class="w-5 h-5 mr-2 text-blue-600" />
                            Contact Information
                        </h2>
                        <div class="space-y-3">
                            <div class="flex items-start">
                                <Mail class="w-5 h-5 mr-2 text-gray-400 mt-0.5" />
                                <div>
                                    <p class="text-gray-600 text-sm">Email</p>
                                    <p class="font-medium">{{ profile.email }}</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <Phone class="w-5 h-5 mr-2 text-gray-400 mt-0.5" />
                                <div>
                                    <p class="text-gray-600 text-sm">Phone</p>
                                    <p class="font-medium">{{ profile.phone_number }}</p>
                                </div>
                            </div>
                            <div v-if="profile.address" class="flex items-start">
                                <MapPin class="w-5 h-5 mr-2 text-gray-400 mt-0.5" />
                                <div>
                                    <p class="text-gray-600 text-sm">Address</p>
                                    <p class="font-medium">
                                        {{ profile.address.house_no }} {{ profile.address.street }}, {{ profile.address.subdivision }}<br>
                                        {{ profile.address.barangay }}, {{ profile.address.city }}<br>
                                        {{ profile.address.province }} {{ profile.address.zip_code }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Stats -->
                    <div class="lg:col-span-2 grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div class="bg-blue-50 rounded-lg p-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-blue-600 text-sm font-medium">Education</p>
                                    <p class="text-2xl font-bold text-blue-900">{{ profile.educations?.length || 0 }}</p>
                                </div>
                                <GraduationCap class="w-8 h-8 text-blue-600" />
                            </div>
                        </div>
                        <div class="bg-green-50 rounded-lg p-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-green-600 text-sm font-medium">Work Experience</p>
                                    <p class="text-2xl font-bold text-green-900">{{ profile.work_experiences?.length || 0 }}</p>
                                </div>
                                <Briefcase class="w-8 h-8 text-green-600" />
                            </div>
                        </div>
                        <div class="bg-purple-50 rounded-lg p-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-purple-600 text-sm font-medium">Trainings</p>
                                    <p class="text-2xl font-bold text-purple-900">{{ profile.trainings?.length || 0 }}</p>
                                </div>
                                <Award class="w-8 h-8 text-purple-600" />
                            </div>
                        </div>
                        <div class="bg-orange-50 rounded-lg p-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-orange-600 text-sm font-medium">Applications</p>
                                    <p class="text-2xl font-bold text-orange-900">{{ applications?.length || 0 }}</p>
                                </div>
                                <FileText class="w-8 h-8 text-orange-600" />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Education Tab -->
                <div v-if="activeTab === 'education'" class="bg-white rounded-lg shadow">
                    <div class="p-6 border-b">
                        <h2 class="text-xl font-semibold flex items-center">
                            <GraduationCap class="w-5 h-5 mr-2 text-blue-600" />
                            Educational Background
                        </h2>
                    </div>
                    <div class="p-6 space-y-6">
                        <div v-for="(edu, index) in profile.educations" :key="index" class="border-l-4 border-blue-600 pl-4 py-2">
                            <h3 class="font-semibold text-lg">{{ edu.level }}</h3>
                            <p class="text-gray-600">{{ edu.school_name }}</p>
                            <p class="text-gray-600">{{ edu.degree_course }}</p>
                            <div class="flex items-center space-x-4 mt-2 text-sm">
                                <span class="text-gray-500">Graduated: {{ edu.year_graduated }}</span>
                                <span v-if="edu.honors_received" class="bg-blue-100 text-blue-800 px-2 py-1 rounded">{{ edu.honors_received }}</span>
                            </div>
                        </div>
                        <p v-if="!profile.educations || profile.educations.length === 0" class="text-gray-500 text-center py-8">
                            No educational background added yet.
                        </p>
                    </div>
                </div>

                <!-- Work Experience Tab -->
                <div v-if="activeTab === 'experience'" class="bg-white rounded-lg shadow">
                    <div class="p-6 border-b">
                        <h2 class="text-xl font-semibold flex items-center">
                            <Briefcase class="w-5 h-5 mr-2 text-blue-600" />
                            Work Experience
                        </h2>
                    </div>
                    <div class="p-6 space-y-6">
                        <div v-for="(work, index) in profile.work_experiences" :key="index" class="border-l-4 border-green-600 pl-4 py-2">
                            <h3 class="font-semibold text-lg">{{ work.position_title }}</h3>
                            <p class="text-gray-600">{{ work.company_name }}</p>
                            <div class="flex items-center space-x-4 mt-2 text-sm text-gray-500">
                                <span>{{ new Date(work.inclusive_date_start).toLocaleDateString() }} - {{ new Date(work.inclusive_date_end).toLocaleDateString() }}</span>
                                <span>₱{{ Number(work.monthly_salary).toLocaleString() }}/month</span>
                                <span class="bg-gray-100 px-2 py-1 rounded">{{ work.status_of_appointment }}</span>
                            </div>
                        </div>
                        <p v-if="!profile.work_experiences || profile.work_experiences.length === 0" class="text-gray-500 text-center py-8">
                            No work experience added yet.
                        </p>
                    </div>
                </div>

                <!-- Applications Tab -->
                <div v-if="activeTab === 'applications'" class="bg-white rounded-lg shadow">
                    <div class="p-6 border-b">
                        <h2 class="text-xl font-semibold flex items-center">
                            <FileText class="w-5 h-5 mr-2 text-blue-600" />
                            Job Applications
                        </h2>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Position</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Applied Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <tr v-for="app in applications" :key="app.id" class="hover:bg-gray-50">
                                    <td class="px-6 py-4">
                                        <p class="font-medium text-gray-900">{{ app.job?.title || 'N/A' }}</p>
                                    </td>
                                    <td class="px-6 py-4 text-gray-600">{{ new Date(app.created_at).toLocaleDateString() }}</td>
                                    <td class="px-6 py-4">
                                        <span :class="`inline-flex items-center space-x-1 px-3 py-1 rounded-full text-xs font-medium ${getStatusColor(app.status)}`">
                                            {{ app.status }}
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <p v-if="!applications || applications.length === 0" class="text-gray-500 text-center py-8">
                            No applications yet.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>