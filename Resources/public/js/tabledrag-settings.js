var tableDragSettings = {
    'term-parent-id': [
        {
            'target': 'term-parent-id',
            'source': 'term-id',
            'relationship': 'parent',
            'action': 'match',
            'hidden': true,
            'limit': 9
        }
    ],
    'term-weight': [
        {
            'target': 'term-weight',
            'source': 'term-weight',
            'relationship': 'sibling',
            'action': 'order',
            'hidden': true,
            'limit': 0
        }
    ]
};
