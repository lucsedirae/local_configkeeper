import ModalSaveCancel from 'core/modal_save_cancel';
import {call as fetchMany} from 'core/ajax';
import Templates from 'core/templates';
import {getString} from 'core/str';

export const init = async (ids) => {
    const rows = await getConfigNotes(ids);

    const context = {
        rows: rows.confignotes,
    };

    const table = await Templates.render('local_configkeeper/confignote_modal_table', context);
    window.console.log('Config Note Modal', context);

    const modal = await ModalSaveCancel.create({
        title: getString('confignote', 'local_configkeeper'),
        body: table,
        removeOnClose: true,
        large: true,
    });

    await modal.show();
};

const getConfigNotes = async (ids) => fetchMany([{
    methodname: 'local_configkeeper_get_confignotes',
    args: {
        ids: ids,
    },
}])[0];
