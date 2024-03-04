<x-adminApp-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <!-- Pie Chart Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Residents Distribution</h3>
                <div style="width: 100%; margin: auto;">
                    <canvas id="pieChart"></canvas>
                </div>
                <script>
                    // Fetch data from the backend (Laravel Blade)
const residentsData = @json($residentsData);

// Prepare data for the pie chart
const data = {
    labels: ['Acknowledged', 'Not Acknowledged', 'Disabled', 'Enabled'],
    datasets: [{
        data: [
            residentsData.acknowledged_rules,
            residentsData.not_acknowledged_rules,
            residentsData.without_disability,
            residentsData.with_disability
        ],
        backgroundColor: ['#A5D8DD', '#EA6A47', '#0091D5', '#202020'],
        hoverBackgroundColor: ['#A5D8DD', '#EA6A47', '#0091D5', '#202020'],
    }],
};


                    // Get the pie chart canvas
                    const ctx = document.getElementById('pieChart').getContext('2d');

                    // Create and render the pie chart
                    const pieChart = new Chart(ctx, {
                        type: 'pie',
                        data: data,
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            legend: {
                                display: true,
                                position: 'right',
                                labels: {
                                    usePointStyle: true,
                                },
                            },
                        },
                    });
                </script>
            </div>

            <!-- Gender Pie Chart Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Gender Distribution</h3>
                <div>
                    <canvas id="genderPieChart"></canvas>
                </div>
                <script>
                    // Get the canvas element
                    const genderCtx = document.getElementById('genderPieChart').getContext('2d');

                    // Create the pie chart
                    const genderPieChart = new Chart(genderCtx, {
                        type: 'pie',
                        data: {
                            labels: ['Male', 'Female'],
                            datasets: [{
                                data: [residentsData.male_count, residentsData.female_count],
                                backgroundColor: ['#1C4E80','#EA6A47'],
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            legend: {
                                display: true,
                                position: 'bottom',
                            }
                        }
                    });
                </script>
            </div>

            <!-- Bar Graph Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Comparison Between Blocks</h3>
                <div>
                    <!-- Dropdown to select data type -->
                    <label for="dataSelector" class="mr-2">Select Data Type:</label>
                    <select id="dataSelector" onchange="changeBarGraphData()" class="p-2" style="width: 150px;"> <!-- Adjust the width as needed -->
                        <option value="household_size">Occupants</option>
                        <option value="violation">Violations</option>
                    </select>
                </div>

                <div class="mt-4">
                    <canvas id="barGraph"></canvas>
                </div>
                <script>
                    // Fetch data from the backend (Laravel Blade)
                    const barGraphData = @json($barGraphData);

                    // Initial data type
                    let selectedDataType = 'household_size';

                    // Function to change bar graph data
                    function changeBarGraphData() {
                        // Get the selected data type from the dropdown
                        selectedDataType = document.getElementById('dataSelector').value;

                        // Call the function to update the bar graph
                        updateBarGraph();
                    }

                    // Function to update the bar graph based on the selected data type
                    function updateBarGraph() {
                        // Prepare data for the bar graph
                        const barData = {
                            labels: barGraphData.map((item, index) => `Block ${index + 1}`),
                            datasets: [{
                                label: selectedDataType === 'household_size' ? 'Average Household Size' : 'Violations',
                                data: barGraphData.map(item => selectedDataType === 'household_size' ? item.average_household_size : item.violations),
                                backgroundColor: selectedDataType === 'household_size' ? '#7E909A' : '#EA6A47',
                            }],
                        };

                        // Get the bar graph canvas
                        const barCtx = document.getElementById('barGraph').getContext('2d');

                        // Check if the chart instance already exists and has a destroy method
                        if (window.barGraph && typeof window.barGraph.destroy === 'function') {
                            // Destroy the existing chart instance
                            window.barGraph.destroy();
                        }

                        // Create and render the new bar graph
                        window.barGraph = new Chart(barCtx, {
                            type: 'bar',
                            data: barData,
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                scales: {
                                    x: {
                                        title: {
                                            display: true,
                                            text: 'Blocks',
                                        },
                                    },
                                    y: {
                                        title: {
                                            display: true,
                                            text: selectedDataType === 'household_size' ? 'Average Household Size' : 'Violations',
                                        },
                                    },
                                },
                            },
                        });
                    }

                    // Initial rendering of the bar graph
                    updateBarGraph();
                </script>
            </div>
        </div>
    </div>
    
</x-adminApp-layout>
