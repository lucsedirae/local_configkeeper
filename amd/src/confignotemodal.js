import Modal from 'core/modal';

export const init = async(rows) => {
    const modal = await Modal.create({
        title: 'Config Note',
        body: rows,
        footer: 'Test footer',
        removeOnClose: true,
    });

    window.console.log('rows', rows);
    await modal.show();
};
