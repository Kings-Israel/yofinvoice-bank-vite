import { createApp } from "vue/dist/vue.esm-bundler"

import VendorFinancing from './components/VendorFinancing.vue'
import Companies from './components/Companies.vue'
import PendingApproval from './components/PendingApproval.vue'

const companies = createApp({})
const pending_appoval = createApp({})

companies.component('CompaniesComponent', Companies)
pending_appoval.component('PendingApprovalComponent', PendingApproval)

createApp(VendorFinancing).mount('#vendor-financing')
companies.mount('#companies')
pending_appoval.mount('#pending-approval')
