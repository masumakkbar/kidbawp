export class CountWordsOnAttachPreview extends $e.modules.hookUI.After {
  getCommand() {
    return 'editor/documents/attach-preview';
  }

  getId() {
    return 'count-words-on-attach-preview';
  }

  apply() {
    // Give some milliseconds to ensure the UI has been updated.
    setTimeout( () => $e.components.get( 'words-counter' ).countWords(), 100 );
  }
}
