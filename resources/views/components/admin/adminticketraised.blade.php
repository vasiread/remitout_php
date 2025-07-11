<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="assets/css/adminedit.css">
</head>

<body>

    @extends('layouts.app')

    @php
    @endphp

    <div class="ticket-raised-container" id="ticket-raised-container-admin-id">
        <div class="ticket-raised-header">
            <h2 class="ticket-raised-title">Tickets Raised</h2>
            <div class="ticket-raised-inbox-filters" id="ticket-raised-index-nbfc-sort-id">
                <span>Sort by </span>
                <img src="assets/images/filter-icon.png" alt="Filters">
                <ul class="ticket-raised-sort-dropdown-nbfc" id="ticket-raised-sort-options-index-nbfc">
                    <li data-sort="az" onclick="sortTickets('az'); event.stopPropagation();">A-Z</li>
                    <li data-sort="za" onclick="sortTickets('za'); event.stopPropagation();">Z-A</li>
                    <li data-sort="newest" onclick="sortTickets('newest'); event.stopPropagation();" class="active">Newest</li>
                    <li data-sort="oldest" onclick="sortTickets('oldest'); event.stopPropagation();">Oldest</li>
                </ul>
            </div>
        </div>

        <div class="ticket-raised-tickets-container" id="ticket-raised-tickets-list"></div>
    </div>

    <script>
        document.getElementById('ticket-raised-index-nbfc-sort-id').addEventListener('click', function (e) {
            const dropdown = document.getElementById('ticket-raised-sort-options-index-nbfc');
            dropdown.classList.toggle('ticket-raised-visible');
            e.stopPropagation();
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function () {
            const dropdown = document.getElementById('ticket-raised-sort-options-index-nbfc');
            dropdown.classList.remove('ticket-raised-visible');
        });

        // Toggle ticket expansion
        function toggleTicket(id, event) {
            event.preventDefault();
            const ticket = document.getElementById(id);

            if (ticket.classList.contains('ticket-raised-expanded')) {
                // Collapse the ticket
                ticket.classList.remove('ticket-raised-expanded');
            } else {
                // Expand the ticket
                ticket.classList.add('ticket-raised-expanded');
            }
        }

       function sortTickets(sortType) {
        try {
            // Get container and ticket elements
            const ticketsContainer = document.getElementById('ticket-raised-tickets-list');
            if (!ticketsContainer) {
                console.error('Tickets container not found');
                return;
            }

            const tickets = Array.from(ticketsContainer.getElementsByClassName('ticket-raised-item'));
            if (tickets.length === 0) {
                console.error('No ticket items found');
                return;
            }

            // Update active sort in dropdown
            const sortOptions = document.querySelectorAll('#ticket-raised-sort-options-index-nbfc li');
            sortOptions.forEach(option => {
                if (option) {
                    option.classList.remove('active');
                    if (option.getAttribute('data-sort') === sortType) {
                        option.classList.add('active');
                    }
                }
            });

            // Sort tickets based on selected option
            tickets.sort((a, b) => {
                const titleA = a.getAttribute('data-title') || '';
                const titleB = b.getAttribute('data-title') || '';
                const dateA = a.getAttribute('data-date') || '1970-01-01';
                const dateB = b.getAttribute('data-date') || '1970-01-01';

                // Log dates for debugging
                console.log('Sorting:', sortType, 'dateA:', dateA, 'dateB:', dateB);

                switch (sortType) {
                    case 'az':
                        return titleA.localeCompare(titleB);
                    case 'za':
                        return titleB.localeCompare(titleA);
                    case 'newest':
                        // Ensure valid dates before comparison
                        const timeA = new Date(dateA).getTime();
                        const timeB = new Date(dateB).getTime();
                        if (isNaN(timeA) || isNaN(timeB)) {
                            console.warn('Invalid date detected:', { dateA, dateB });
                            return 0; // Treat invalid dates as equal
                        }
                        return timeB - timeA; // Newest first (descending)
                    case 'oldest':
                        // Ensure valid dates before comparison
                        const timeAOld = new Date(dateA).getTime();
                        const timeBOld = new Date(dateB).getTime();
                        if (isNaN(timeAOld) || isNaN(timeBOld)) {
                            console.warn('Invalid date detected:', { dateA, dateB });
                            return 0; // Treat invalid dates as equal
                        }
                        return timeAOld - timeBOld; // Oldest first (ascending)
                    default:
                        return 0;
                }
            });

            // Clear and rebuild the container
            ticketsContainer.innerHTML = ''; // Clear the container
            tickets.forEach(ticket => {
                if (ticket) {
                    ticketsContainer.appendChild(ticket); // Re-append sorted tickets
                }
            });

            // Hide dropdown after selection
            const dropdown = document.getElementById('ticket-raised-sort-options-index-nbfc');
            if (dropdown) {
                dropdown.classList.remove('ticket-raised-visible');
            }
        } catch (error) {
            console.error('Error in sortTickets function:', error);
        }
    }

    async function getTickets() {
    try {
        const response = await fetch('/get-tickets');
        if (!response.ok) throw new Error('Network response was not ok');

        const data = await response.json();
        // console.log('Fetched data:', data);

        if (data.success && Array.isArray(data.queries)) {
            const ticketContainer = document.getElementById('ticket-raised-tickets-list');
            ticketContainer.innerHTML = '';

            data.queries.forEach(ticket => {
                const ticketDateStr = ticket.created_at.split('.')[0];
                const ticketDate = new Date(ticketDateStr);
                const formattedDate = !isNaN(ticketDate) ? ticketDate.toISOString().split('T')[0] : '1970-01-01';

                const ticketItem = document.createElement('div');
                ticketItem.classList.add('ticket-raised-item');
                if (ticket.status === 'deactive') {
                    ticketItem.classList.add('deactivated');
                }

                // Set data attributes for sorting
                ticketItem.dataset.id = ticket.id;
                ticketItem.dataset.title = ticket.queryraised || 'Untitled';
                ticketItem.dataset.date = formattedDate;

                ticketItem.innerHTML = `
                    <div class="ticket-raised-content">
                        ${ticket.queryraised}
                    </div>
                    <div class="ticket-raised-meta">
                        <div class="ticket-raised-meta-item-sc">Student Counsellor</div>
                        <div class="ticket-raised-meta-item-date">${formattedDate}</div>
                        <div class="ticket-raised-meta-item-student">${ticket.querytype || 'No Type'}</div>
                    </div>
                    <div class="ticket-raised-chat-icon-container">
                        <div class="ticket-raised-chat-icon" style="border:1px solid #6f25ce;border-radius:4px;color:#6f25ce;">
                            <p>x</p>
                        </div>
                    </div>
                `;

                // Attach click event to the chat icon container only
                const chatIconContainer = ticketItem.querySelector('.ticket-raised-chat-icon-container');
                chatIconContainer.addEventListener('click', async (e) => {
                    e.stopPropagation(); // Prevent the click from bubbling up to the ticketItem
                    const ticketId = ticketItem.dataset.id;

                    const updateResponse = await fetch('/update-ticket-status', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ id: ticketId })
                    });

                    const result = await updateResponse.json();
                    if (result.success) {
                        ticketItem.classList.add('deactivated');
                        alert('Ticket marked as deactive.');
                        getTickets(); // Refresh the ticket list
                    } else {
                        alert('Failed to update ticket status.');
                    }
                });

                ticketContainer.appendChild(ticketItem);
            });

            sortTickets('newest');
        } else {
            console.error('No tickets found in the response');
        }
    } catch (error) {
        console.error('Failed to fetch tickets:', error);
    }
}

    // Close dropdown when clicking outside
    document.addEventListener('click', function (e) {
        const dropdown = document.getElementById('ticket-raised-sort-options-index-nbfc');
        const sortButton = document.getElementById('ticket-raised-index-nbfc-sort-id');
        if (dropdown && !dropdown.contains(e.target) && !sortButton.contains(e.target)) {
            dropdown.classList.remove('ticket-raised-visible');
        }
    });

        document.addEventListener('DOMContentLoaded', () => {
            getTickets();
        });
    </script>
</body>

</html>